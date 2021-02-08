<?php

declare(strict_types=1);


namespace Components\Route;

use Closure;
use Domain\Admin\Accounts\User\Models\User;
use Components\Validate\Exceptions\Basic\UndefinedRouteException;
use Components\Validate\Validate;
use System\View\DomainView;

/**
 * Provides a class for interacting with the routes and executing a route.
 *
 * @package Components\Route
 */
final class Router implements RouterInterface {

  /**
   * All the routes, stored based on the request type -> rights -> url.
   *
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
  protected static array $routes = [
    self::HTTP_TYPE_GET => [],
    self::HTTP_TYPE_POST => [],
  ];

  /**
   * All the available routes based on the current rights of the user.
   *
   * @var array[]
   */
  protected static array $availableRoutes = [];

  /**
   * The current used prefixes for the routes.
   *
   * @var string[]
   */
  protected static array $prefixes = [];

  /**
   * The prefix for the routes, converted from the prefixes.
   *
   * @var string
   */
  protected static string $prefix = '';

  /**
   * The current used wildcard. Currently a maximum of 1 wildcard can be used.
   *
   * @var string
   */
  protected static string $wildcard = '';

  /**
   * {@inheritDoc}
   */
  public static function load(array $routes): Router {
    self::resetRoutes();

    foreach ($routes as $route) {
      include_file($route);
    }

    return new self();
  }

  /**
   * {@inheritDoc}
   */
  public static function get(string $route, string $controller, string $method = self::METHOD_DEFAULT, int $rights = User::GUEST): void {
    $route = self::prefixRoute($route);

    self::$routes[self::HTTP_TYPE_GET][$rights][$route] = [$controller, $method];
  }

  /**
   * {@inheritDoc}
   */
  public static function post(string $route, string $controller, string $method = self::METHOD_DEFAULT, int $rights = User::GUEST): void {
    $route = self::prefixRoute($route);

    self::$routes[self::HTTP_TYPE_POST][$rights][$route] = [$controller, $method];
  }

  /**
   * {@inheritDoc}
   */
  public static function prefix(string $prefix): Router {
    self::$prefixes[] = $prefix;

    return new self();
  }

  /**
   * Add the prefixes to the given route.
   *
   * @param string $route
   *   The route.
   *
   * @return string
   *   The prefixed route.
   */
  protected static function prefixRoute(string $route): string {
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
   * {@inheritDoc}
   */
  public function group(Closure $routes): void {
    $routes($this);

    self::$prefix = $this->updatePrefixes();
  }

  /**
   * Updates the prefixes.
   *
   * Remove the last prefix from the prefixes.
   * This must be done in order to be able to group routes with a new prefix.
   *
   * @return string
   *   The updated prefix.
   */
  protected function updatePrefixes(): string {
    $prefixes = explode('/', self::$prefix);
    if (count($prefixes) === 0) {
      return '';
    }

    $lastKey = array_key_last(self::$prefixes);
    unset(self::$prefixes[$lastKey]);

    return implode('/', self::$prefixes);
  }

  /**
   * {@inheritDoc}
   */
  public function direct(string $url, string $requestType, int $rights): string|DomainView {
    $this->setAvailableRoutes($requestType, $rights);
    $this->replaceWildcards($url);
    if (isset(self::$availableRoutes[$url])) {
      return $this->executeRoute($url);
    }

    $this->setAvailableRoutes(self::HTTP_TYPE_GET, $rights);
    if (isset(self::$availableRoutes[self::URL_PAGE_NOT_FOUND])) {
      return $this->executeRoute(self::URL_PAGE_NOT_FOUND);
    }

    throw new UndefinedRouteException();
  }

  /**
   * Executes the route and call the controller.
   *
   * @param string $url
   *   The url to search for a corresponding route.
   *
   * @return \System\View\DomainView|string
   *   The returned output of the controller.
   *
   * @throws \Components\Validate\Exceptions\Object\InvalidObjectException
   * @throws \Components\Validate\Exceptions\Object\InvalidMethodCalledException
   */
  protected function executeRoute(string $url): DomainView|string {
    $route = self::$availableRoutes[$url];
    $controller = new $route[0]();
    $methodName = (string) $route[1];

    Validate::var($controller)->isObject();
    Validate::var($controller)->methodExists($methodName);

    return $controller->{$methodName}();
  }

  /**
   * Sets the available routes based on the current rights of the user.
   *
   * @param string $requestType
   *   The request type.
   * @param int $rights
   *   The rights of the user.
   */
  protected function setAvailableRoutes(string $requestType, int $rights): void {
    self::$availableRoutes = [];
    for ($maximumRights = 0; $maximumRights <= $rights; ++$maximumRights) {
      if (isset(self::$routes[$requestType][$maximumRights])) {
        foreach (self::$routes[$requestType][$maximumRights] as $url => $route) {
          self::$availableRoutes[$url] = $route;
        }
      }
    }
  }

  /**
   * Replace the wildcards and stores the current used wildcard.
   *
   * @param string $url
   *   The current url.
   */
  protected function replaceWildcards(string $url): void {
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
   * Replaces the slug for the matching value from the url.
   *
   * @param string[] $routeExploded
   *   The route exploded in parts divided by slashes.
   * @param string[] $urlExploded
   *   The url exploded in parts divided by slashes.
   * @param string $route
   *   The route to search for a replacement.
   */
  protected function updateRoute(array $routeExploded, array $urlExploded, string $route): void {
    if (count($urlExploded) !== count($routeExploded)) {
      return;
    }

    // If the route is not equal to the url, except for the wildcard, exit.
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

    // Walk through the exploded route array and if there is a match and if it
    // contains {a-zA-Z} replace it with the same value on the same position
    // from the url exploded array.
    foreach ($routeExploded as $key => $routePart) {
      if (!isset($urlExploded[$key]) || !preg_match('/{+[a-zA-Z]+}/', $routePart)) {
        continue;
      }

      $newRoute = preg_replace('/{+[a-zA-Z]+}/', $urlExploded[$key], $route);
      self::$wildcard = $urlExploded[$key];
      self::$availableRoutes = array_replace_keys(self::$availableRoutes, [$route => $newRoute]);
    }
  }

  /**
   * Returns the current used wildcard.
   *
   * @return string
   *   The wildcard.
   */
  public static function getWildcard(): string {
    return self::$wildcard;
  }

  /**
   * Resets all the current stored routes.
   */
  protected static function resetRoutes(): void {
    self::$routes = [
      self::HTTP_TYPE_GET => [],
      self::HTTP_TYPE_POST => [],
    ];
    self::$availableRoutes = [];
  }

}
