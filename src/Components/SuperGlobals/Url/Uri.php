<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Url;

use Components\ComponentsTrait;
use Components\SuperGlobals\Request;
use Components\Sanitize\Sanitize;

/**
 * Provides an class for interacting with the url.
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
    $request = new Request();
    $sanitize = new Sanitize($request->server(Request::URI), 'url');

    return (string) $sanitize->data();
  }

  /**
   * Get the used method for accessing the page.
   *
   * @return string
   */
  public static function getMethod(): string {
    $request = new Request();

    return $request->server(Request::METHOD);
  }

  /**
   * Get the previous url.
   *
   * @return string
   */
  public static function getPreviousUrl(): string {
    $request = new Request();

    $sanitize = new Sanitize(
          $request->server(Request::HTTP_REFERER),
          'url'
      );

    return (string) $sanitize->data();
  }

  /**
   * Get the domain extension.
   *
   * @return string
   */
  public static function getDomainExtension(): string {
    $request = new Request();

    $hostExploded = explode('.', $request->server(Request::HTTP_HOST));
    $arrayKeyLast = array_key_last($hostExploded);

    return $hostExploded[$arrayKeyLast] ?? 'nl';
  }

}
