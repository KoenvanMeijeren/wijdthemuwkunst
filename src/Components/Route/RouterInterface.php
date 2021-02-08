<?php

namespace Components\Route;


use Closure;
use Domain\Admin\Accounts\User\Models\User;
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
   *   If the routes file does not exists.
   */
  public static function load(array $routes): Router;

  /**
   * Defines the get routes.
   *
   * @param string $route
   *   The route.
   * @param string $controller
   *   The controller to execute when the route is called.
   * @param string $method
   *   The method from the controller.
   * @param int $rights
   *   The minimum rights to be able to visit routes based on the given rights.
   */
  public static function get(string $route, string $controller, string $method = self::METHOD_DEFAULT, int $rights = User::GUEST): void;

  /**
   * Defines the post routes.
   *
   * @param string $route
   *   The route.
   * @param string $controller
   *   The controller to execute when the route is called.
   * @param string $method
   *   The method from the controller.
   * @param int $rights
   *   The minimum rights to be able to visit routes based on the given rights.
   */
  public static function post(string $route, string $controller, string $method = self::METHOD_DEFAULT, int $rights = User::GUEST): void;

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
