<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Url;

use Components\ComponentsTrait;
use Components\Sanitize\Sanitize;
use Components\SuperGlobals\RequestInterface;

/**
 * Provides a class for interacting with the url.
 *
 * @package Components\SuperGlobals\Url
 */
final class Uri {

  use ComponentsTrait;

  /**
   * Gets the url.
   *
   * @return string
   */
  public static function getUrl(): string {
    $sanitize = new Sanitize(self::requestStatic()->server(RequestInterface::URI), 'url');

    return (string) $sanitize->data();
  }

  /**
   * Get the used method for accessing the page.
   *
   * @return string
   */
  public static function getMethod(): string {
    return self::requestStatic()->server(RequestInterface::METHOD);
  }

  /**
   * Get the previous url.
   *
   * @return string
   */
  public static function getPreviousUrl(): string {
    $sanitize = new Sanitize(self::requestStatic()->server(RequestInterface::HTTP_REFERER), 'url');

    return (string) $sanitize->data();
  }

  /**
   * Get the domain extension.
   *
   * @return string
   */
  public static function getDomainExtension(): string {
    $hostExploded = explode('.', self::requestStatic()->server(RequestInterface::HTTP_HOST));
    $arrayKeyLast = array_key_last($hostExploded);

    return $hostExploded[$arrayKeyLast] ?? 'nl';
  }

}
