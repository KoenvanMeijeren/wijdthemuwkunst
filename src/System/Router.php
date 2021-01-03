<?php

declare(strict_types=1);


namespace System;

use Closure;
use Domain\Admin\Accounts\User\Models\User;
use Src\Exceptions\Basic\UndefinedRouteException;
use Src\Validate\Validate;

/**
 * @deprecated
 */
final class Router {
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
   *
   * @var array[]
   */
  private static array $routes = [
    'GET' => [],
    'POST' => [],
  ];

  /**
   * All the available routes based on the current rights of the user.
   *
   * @var array[]
   */
  private static array $availableRoutes = [];

  /**
   * The current used prefixes for the routes.
   *
   * @var string[]
   */
  private static array $prefixes = [];

  /**
   * The prefix for the routes, converted from the prefixes.
   */
  private static string $prefix = '';

  /**
   * The current used wildcard. Currently a maximum of 1 wildcard can be used.
   */
  private static string $wildcard = '';

  /**
   * Load the routes.
   *
   * @param array $routes
   *   The routes of the application.
   *
   * @return Router
   *   The router object.
   */
  public static function load(array $routes): Router {
    self::resetRoutes();

    foreach ($routes as $route) {
      include_file($route);
    }

    return new self();
  }

  /**
   * Define the get routes.
   *
   * @param string $route
   *   the get route.
   * @param string $controller
   *   the controller to execute when
   *   the route is called.
   * @param string $method
   *   a specific method from the controller.
   * @param int $rights
   *   the rights of the user to be able to
   *   visit routes based on the given rights.
   */
  public static function get(
        string $route,
        string $controller,
        string $method = 'index',
        int $rights = User::GUEST
    ): void {
    $route = self::prefixRoute($route);

    self::$routes['GET'][$rights][$route] = [$controller, $method];
  }

  /**
   * Define the post routes.
   *
   * @param string $route
   *   the post route.
   * @param string $controller
   *   the controller to execute when
   *   the route is called.
   * @param string $method
   *   a specific method from the controller.
   * @param int $rights
   *   the rights of the user to be able to
   *   visit routes based on the given rights.
   */
  public static function post(
        string $route,
        string $controller,
        string $method = 'index',
        int $rights = User::GUEST
    ): void {
    $route = self::prefixRoute($route);

    self::$routes['POST'][$rights][$route] = [$controller, $method];
  }

  /**
   * Prefix some routes.
   *
   * @param string $prefix
   *
   * @return Router
   */
  public static function prefix(string $prefix): Router {
    self::$prefixes[] = $prefix;

    return new Router();
  }

  /**
   * Add the prefixes to the given route.
   *
   * @param string $route
   *
   * @return string the prefixed route.
   */
  private static function prefixRoute(string $route): string {
    // If there are not available prefixes, return the route.
    if (count(self::$prefixes) < 1) {
      return $route;
    }

    // Convert the prefixes to one prefix and return the (prefixed) route.
    $prefix = implode('/', self::$prefixes);
    if ($prefix === '') {
      return $route;
    }

    self::$prefix = $prefix;
    if ($route !== '') {
      return self::$prefix . '/' . $route;
    }

    return self::$prefix;
  }

  /**
   * Group some routes.
   *
   * @param \Closure $routes
   */
  public function group(Closure $routes): void {
    $routes($this);

    self::$prefix = $this->updatePrefixes();
  }

  /**
   * Update the prefixes.
   *
   * Remove the last prefix from the prefixes.
   * This must be done in order to be able to group routes with a new prefix.
   *
   * @return string The updated prefix.
   */
  private function updatePrefixes(): string {
    $prefixes = explode('/', self::$prefix);
    if (count($prefixes) === 0) {
      return '';
    }

    $lastKey = array_key_last(self::$prefixes);
    unset(self::$prefixes[$lastKey]);

    return implode('/', self::$prefixes);
  }

  /**
   * Direct an url to a controller.
   *
   * @param string $url
   *   the current url to search for the
   *   corresponding route in the routes.
   * @param string $requestType
   *   the request type.
   * @param int $rights
   *   the rights of the user.
   *
   * @return \System\View\DomainView|string
   *
   * @throws \Src\Exceptions\Object\InvalidObjectException
   * @throws \Src\Exceptions\Object\InvalidMethodCalledException
   * @throws \Src\Exceptions\Basic\UndefinedRouteException
   */
  public function direct(string $url, string $requestType, int $rights) {
    $this->setAvailableRoutes($requestType, $rights);
    $this->replaceWildcards($url);
    if (array_key_exists($url, self::$availableRoutes)) {
      return $this->executeRoute($url);
    }

    $this->setAvailableRoutes('GET', $rights);
    if (array_key_exists('pageNotFound', self::$availableRoutes)) {
      return $this->executeRoute('pageNotFound');
    }

    throw new UndefinedRouteException();
  }

  /**
   * Execute the route and call the controller.
   *
   * @param string $url
   *   the current url to search for the
   *   corresponding route in the routes.
   *
   * @return \Src\View\DomainView|string
   *
   * @throws \Src\Exceptions\Object\InvalidObjectException
   * @throws \Src\Exceptions\Object\InvalidMethodCalledException
   */
  private function executeRoute(string $url) {
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
   * @param string $requestType
   *   the request type to access the page.
   * @param int $rights
   *   the rights of the user of the app.
   */
  private function setAvailableRoutes(string $requestType, int $rights): void {
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
   * @param string $url
   *   the current url.
   */
  private function replaceWildcards(string $url): void {
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
   * @param string[] $routeExploded
   *   the route exploded in parts divided by slashes.
   * @param string[] $urlExploded
   *   the url exploded in parts divided by slashes.
   * @param string $route
   *   the route to search for a replacement.
   */
  private function updateRoute(
        array $routeExploded,
        array $urlExploded,
        string $route
    ): void {
    // If route and url exploded are not the same size, return void.
    if (count($urlExploded) !== count($routeExploded)) {
      return;
    }

    // If the route is not equal to the url,
    // except for the wildcard, return void.
    $falseMatches = 0;
    $urlParts = count($urlExploded);
    for ($key = 0; $key < $urlParts; $key++) {
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
    // same position from the url exploded array.
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
        self::$availableRoutes = array_replace_keys(
              self::$availableRoutes,
              [$route => $newRoute]
          );
        // @codeCoverageIgnoreEnd
      }
    }
  }

  /**
   * Return the current used wildcard.
   *
   * @return string
   */
  public static function getWildcard(): string {
    return self::$wildcard;
  }

  /**
   * Reset all the current stored routes.
   */
  private static function resetRoutes(): void {
    self::$routes = [
      'GET' => [],
      'POST' => [],
    ];
    self::$availableRoutes = [];
  }

}
