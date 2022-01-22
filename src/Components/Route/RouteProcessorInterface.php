<?php
declare(strict_types=1);

namespace Components\Route;

use Components\Http\HttpTypes;
use System\View\DomainView;

/**
 * Provides an interface for RouteProcessorInterface.
 *
 * @package Components\Route;
 */
interface RouteProcessorInterface {

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
   * Directs an url to a controller.
   *
   * @param string $url
   *   The url to search for a corresponding route.
   * @param HttpTypes $httpType
   *   The HTTP type.
   * @param \Components\Route\RouteRights $rights
   *   The rights of the user.
   *
   * @return \System\View\DomainView|string
   *   The returned output of the controller.
   *
   * @throws \Components\Validate\Exceptions\Object\InvalidObjectException
   * @throws \Components\Validate\Exceptions\Object\InvalidMethodCalledException
   * @throws \Components\Validate\Exceptions\Basic\UndefinedRouteException
   */
  public function direct(string $url, HttpTypes $httpType, RouteRights $rights): string|DomainView;

  /**
   * Returns the current used wildcard.
   *
   * @return string
   *   The wildcard.
   */
  public static function getWildcard(): string;

}
