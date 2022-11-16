<?php
declare(strict_types=1);

namespace Components\Route;

use Components\Http\HttpTypes;
use Components\Validate\Exceptions\Basic\UndefinedRouteException;
use Components\Validate\Validate;
use System\View\DomainView;

/**
 * Provides a class for RouteProcessor.
 *
 * @package Components\Route;
 */
final class RouteProcessor implements RouteProcessorInterface {

  /**
   * The route wildcard.
   *
   * @var string|int
   */
  protected static string $wildcard;

  /**
   * Constructs a new route processor.
   *
   * @param \Components\Route\RouteCollection $routeCollection
   *   The route collection.
   */
  public function __construct(
    protected RouteCollection $routeCollection
  ) {}

  /**
   * {@inheritDoc}
   */
  public function direct(string $url, HttpTypes $httpType, RouteRights $rights): string|DomainView {
    $available_routes = $this->routeCollection->getAvailableRoutes($httpType, $rights);
    $this->replaceWildcards($available_routes, $url);
    if (isset($available_routes[$url])) {
      return $this->executeRoute($available_routes[$url]);
    }

    $available_routes = $this->routeCollection->getAvailableRoutes(HttpTypes::GET, $rights);
    if (isset($available_routes[self::URL_PAGE_NOT_FOUND])) {
      return $this->executeRoute($available_routes[self::URL_PAGE_NOT_FOUND]);
    }

    throw new UndefinedRouteException();
  }

  /**
   * {@inheritDoc}
   */
  public static function getWildcard(): string {
    return self::$wildcard;
  }

  /**
   * Executes the route and call the controller.
   *
   * @param \Components\Route\RouteGet|\Components\Route\RoutePost $route
   *   The route.
   *
   * @return \System\View\DomainView|string
   *   The returned output of the controller.
   *
   * @throws \Components\Validate\Exceptions\Object\InvalidMethodCalledException
   * @throws \Components\Validate\Exceptions\Object\InvalidObjectException
   */
  protected function executeRoute(RouteGet|RoutePost $route): DomainView|string {
    $instance = $route->instantiateClass();
    Validate::var($instance)->isObject();
    Validate::var($instance)->methodExists($route->method);

    return $instance->{$route->method}();
  }

  /**
   * Replace the wildcards and stores the current used wildcard.
   *
   * @param array $availableRoutes
   *   The available routes.
   * @param string $url
   *   The current url.
   */
  protected function replaceWildcards(array &$availableRoutes, string $url): void {
    $urlExploded = explode('/', $url);
    $routes = array_keys($availableRoutes);

    foreach ($routes as $route) {
      $routeExploded = explode('/', $route);

      if (preg_match('/{+[a-zA-Z]+}/', $route)) {
        $this->updateRoute($availableRoutes, $routeExploded, $urlExploded, $route);
      }
    }
  }

  /**
   * Replaces the slug for the matching value from the url.
   *
   * @param array $availableRoutes
   *   The available routes.
   * @param string[] $routeExploded
   *   The route exploded in parts divided by slashes.
   * @param string[] $urlExploded
   *   The url exploded in parts divided by slashes.
   * @param string $route
   *   The route to search for a replacement.
   */
  protected function updateRoute(array &$availableRoutes, array $routeExploded, array $urlExploded, string $route): void {
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
      $availableRoutes = array_replace_keys($availableRoutes, [$route => $newRoute]);
    }
  }

}
