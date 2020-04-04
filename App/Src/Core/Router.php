<?php
declare(strict_types=1);


namespace Src\Core;

use Closure;
use Domain\Admin\Accounts\User\Models\User;
use Src\Exceptions\Basic\UndefinedRouteException;
use Src\Exceptions\Object\InvalidMethodCalledException;
use Src\Exceptions\Object\InvalidObjectException;
use Src\Validate\Validate;
use Src\View\DomainView;

final class Router
{
    /**
     * All the routes, stored based on the request type -> rights -> url.
     * For example:
     * GET =>
     *      0 => [
     *          'some_route_unauthorized' => ...
     *          ],
     *      1 => [
     *          'some_route_authorized' => ...
     *          ],
     *      ...
     */
    private static array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    /**
     * All the available routes based on the current rights of the user.
     */
    private static array $availableRoutes = [];

    private static string $prefix = '';
    private static string $wildcard = '';

    /**
     * Load the routes.
     *
     * @param string $file          the file location of the routes
     * @param string $directoryPath the directory location of the routes
     *
     * @return Router
     */
    public static function load(
        string $file = 'web.php',
        string $directoryPath = ROUTES_PATH . '/'
    ): Router {
        self::resetRoutes();
        includeFile($directoryPath.$file);

        return new self();
    }

    /**
     * Define the get routes.
     *
     * @param string $route      the get route
     * @param string $controller the controller to execute when
     *                           the route is called
     * @param string $method     a specific method from the controller
     * @param int    $rights     the rights of the user to be able to
     *                           visit routes based on the given rights
     */
    public static function get(
        string $route,
        string $controller,
        string $method = 'index',
        int $rights = User::GUEST
    ): void {
        $route = self::addRoutePrefix($route);

        self::$routes['GET'][$rights][$route] = [$controller, $method];
    }

    /**
     * Define the post routes.
     *
     * @param string $route      the post route
     * @param string $controller the controller to execute when
     *                           the route is called
     * @param string $method     a specific method from the controller
     * @param int    $rights     the rights of the user to be able to
     *                           visit routes based on the given rights
     */
    public static function post(
        string $route,
        string $controller,
        string $method = 'index',
        int $rights = User::GUEST
    ): void {
        $route = self::addRoutePrefix($route);

        self::$routes['POST'][$rights][$route] = [$controller, $method];
    }

    /**
     * Store the prefix.
     *
     * @param string $prefix
     *
     * @return Router
     */
    public static function prefix(string $prefix): Router
    {
        self::$prefix = $prefix;

        return new static();
    }

    /**
     * Group some routes.
     *
     * @param Closure $routes
     */
    public function group(Closure $routes): void
    {
        $routes($this);

        self::$prefix = '';
    }

    /**
     * Return the current used wildcard.
     *
     * @return string
     */
    public static function getWildcard(): string
    {
        return self::$wildcard;
    }

    /**
     * Direct an url to a controller.
     *
     * @param string $url         the current url to search for the
     *                            corresponding route in the routes
     * @param string $requestType the request type
     * @param int    $rights      the rights of the user
     *
     * @return DomainView|string
     *
     * @throws InvalidObjectException
     * @throws InvalidMethodCalledException
     * @throws UndefinedRouteException
     */
    public function direct(string $url, string $requestType, int $rights)
    {
        $this->setAvailableRoutes($requestType, $rights);
        $this->replaceWildcards($url);
        if (array_key_exists($url, self::$availableRoutes)) {
            return $this->executeRoute($url);
        }

        $this->setAvailableRoutes('GET', $rights);
        if (array_key_exists('pageNotFound', self::$availableRoutes)) {
            return $this->executeRoute('pageNotFound');
        }

        throw new UndefinedRouteException(
            'No route defined for this request'
        );
    }

    /**
     * Execute the route and call the controller.
     *
     * @param string $url the current url to search for the
     *                    corresponding route in the routes
     *
     * @return DomainView|string
     *
     * @throws InvalidObjectException
     * @throws InvalidMethodCalledException
     */
    private function executeRoute(string $url)
    {
        $route = self::$availableRoutes[$url];
        $controller = new $route[0]();
        $methodName = (string) $route[1];

        Validate::var($controller)->isObject();
        Validate::var($controller)->methodExists($methodName);

        return $controller->{$methodName}();
    }

    /**
     * Set the available routes based on the current rights of the user.
     *
     * @param string $requestType the request type to access the page
     * @param int    $rights      the rights of the user of the app
     */
    private function setAvailableRoutes(string $requestType, int $rights): void
    {
        self::$availableRoutes = [];
        for ($maximumRights = 0; $maximumRights <= $rights; ++$maximumRights) {
            if (array_key_exists($requestType, self::$routes)
                && array_key_exists(
                    $maximumRights,
                    self::$routes[$requestType]
                )
            ) {
                foreach (self::$routes[$requestType][$maximumRights] as $url => $route) {
                    self::$availableRoutes[$url] = $route;
                }
            }
        }
    }

    /**
     * Replace the wildcards in the given routes.
     * Store the current used wildcard.
     *
     * @param string $url the current url
     */
    private function replaceWildcards(string $url): void
    {
        $urlExploded = explode('/', $url);
        $routes = array_keys(self::$availableRoutes);

        foreach ($routes as $route) {
            $routeExploded = explode('/', $route);

            if ((bool) preg_match('/{+[a-zA-Z]+}/', $route)) {
                $this->updateRoute($routeExploded, $urlExploded, $route);
            }
        }
    }

    /**
     * Update a specific route. Replace the slug for the matching value from the url.
     *
     * @param string[] $routeExploded the route exploded in parts divided by slashes
     * @param string[] $urlExploded   the url exploded in parts divided by slashes
     * @param string   $route         the route to search for a replacement
     */
    private function updateRoute(
        array $routeExploded,
        array $urlExploded,
        string $route
    ): void {
        // if route and url exploded are not the same size, return void.
        if (count($urlExploded) !== count($routeExploded)) {
            return;
        }

        // If the route is not equal to the url,
        // except for the wildcard, return void.
        $falseMatches = 0;
        $urlParts = count($urlExploded);
        for ($key = 0; $key < $urlParts; $key++){
            $routePart = $routeExploded[$key];
            $urlPart = $urlExploded[$key];

            if ($urlPart !== $routePart) {
                $falseMatches++;
            }
        }

        if ($falseMatches > 1) {
            return;
        }

        // Walk through the exploded route array and if there is a match and
        // if it contains {a-zA-Z} replace it with the same value on the
        // same position from the url exploded array
        foreach ($routeExploded as $key => $routePart) {
            if (array_key_exists($key, $urlExploded)
                && (bool) preg_match('/{+[a-zA-Z]+}/', $routePart)
            ) {
                $newRoute = preg_replace(
                    '/{+[a-zA-Z]+}/',
                    $urlExploded[$key],
                    $route
                );
                self::$wildcard = $urlExploded[$key];
                // @codeCoverageIgnoreStart
                self::$availableRoutes = arrayReplaceKeys(
                    self::$availableRoutes,
                    [$route => $newRoute]
                );
                // @codeCoverageIgnoreEnd
            }
        }
    }

    /**
     * Add the prefix to the given route.
     *
     * @param string $route
     * @return string the prefixed route.
     */
    private static function addRoutePrefix(string $route): string
    {
        if (self::$prefix !== '' && $route !== '') {
            return self::$prefix . '/' . $route;
        }

        if (self::$prefix !== '') {
            return self::$prefix;
        }

        return $route;
    }

    /**
     * Reset all the current stored routes.
     */
    private static function resetRoutes(): void
    {
        self::$routes = [
            'GET' => [],
            'POST' => [],
        ];
        self::$availableRoutes = [];
    }
}
