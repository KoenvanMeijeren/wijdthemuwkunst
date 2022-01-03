<?php

namespace Components\Route;


use Closure;
use Modules\User\Entity\AccountInterface;
use System\View\DomainView;

/**
 * Provides an interface for interacting with the routes and executing a route.
 *
 * @package Components\Route
 */
interface RouterInterface {

  /**
   * The various HTTP types.
   *
   * @var string
   */
  public const HTTP_TYPE_GET = 'GET';
  public const HTTP_TYPE_POST = 'POST';

  /**
   * The default controller method to be executed.
   *
   * @var string
   */
  public const METHOD_DEFAULT = 'index';

  /**
   * The url of the page not found.
   *
   * @var string
   */
  public const URL_PAGE_NOT_FOUND = 'pageNotFound';

  /**
   * Loads the routes.
   *
   * @param array $routes
   *   The routes of the application.
   *
   * @return Router
   *   The router object.
   *
   * @throws \Components\File\Exceptions\FileNotFoundException
   *   If the routes file does not exist.
   */
  public static function load(array $routes): Router;

  /**
   * Tries to get an url from a given route.
   *
   * @param string $route
   *   The route.
   *
   * @return string|null
   *   The url or null.
   */
  public static function urlFromRoute(string $route): ?string;

  /**
   * Defines the get routes.
   *
   * @param string $url
   *   The url.
   * @param string $controller
   *   The controller to execute when the route is called.
   * @param string $method
   *   The method from the controller.
   * @param int $rights
   *   The minimum rights to be able to visit routes based on the given rights.
   * @param string|null $route
   *   The route.
   */
  public static function get(string $url, string $controller, string $method = self::METHOD_DEFAULT, int $rights = AccountInterface::GUEST, string $route = NULL): void;

  /**
   * Defines the post routes.
   *
   * @param string $url
   *   The url.
   * @param string $controller
   *   The controller to execute when the route is called.
   * @param string $method
   *   The method from the controller.
   * @param int $rights
   *   The minimum rights to be able to visit routes based on the given rights.
   * @param string|null $route
   *   The route.
   */
  public static function post(string $url, string $controller, string $method = self::METHOD_DEFAULT, int $rights = AccountInterface::GUEST, string $route = NULL): void;

  /**
   * Prefixes a group of routes.
   *
   * @param string $prefix
   *   The prefix.
   *
   * @return Router
   *   The newly created router.
   */
  public static function prefix(string $prefix): Router;

  /**
   * Groups some routes.
   *
   * @param \Closure $routes
   *   The routes to be grouped.
   */
  public function group(Closure $routes): void;

  /**
   * Directs an url to a controller.
   *
   * @param string $url
   *   The url to search for a corresponding route.
   * @param string $requestType
   *   The request type.
   * @param int $rights
   *   The rights of the user.
   *
   * @return \System\View\DomainView|string
   *   The returned output of the controller.
   *
   * @throws \Components\Validate\Exceptions\Object\InvalidObjectException
   * @throws \Components\Validate\Exceptions\Object\InvalidMethodCalledException
   * @throws \Components\Validate\Exceptions\Basic\UndefinedRouteException
   */
  public function direct(string $url, string $requestType, int $rights): string|DomainView;

}
