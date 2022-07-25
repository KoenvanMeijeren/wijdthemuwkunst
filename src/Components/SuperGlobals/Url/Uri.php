<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Url;

use Components\ComponentsTrait;
use Components\Http\HttpTypes;
use Components\Sanitize\DataTypes;
use Components\Sanitize\Sanitize;
use Components\SuperGlobals\ServerOptions;

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
    $sanitize = new Sanitize(self::requestStatic()->server->get(ServerOptions::URI), DataTypes::URL);

    return (string) $sanitize->data();
  }

  /**
   * Get the used HTTP method for accessing the page.
   *
   * @return \Components\Http\HttpTypes
   *   The HTTP type.
   *
   * @throws \Components\Http\InvalidHttpTypeException
   */
  public static function getHttpType(): HttpTypes {
    return HttpTypes::set(self::requestStatic()->server->get(ServerOptions::METHOD));
  }

  /**
   * Get the previous url.
   *
   * @return string
   */
  public static function getPreviousUrl(): string {
    $sanitize = new Sanitize(self::requestStatic()->server->get(ServerOptions::HTTP_REFERER), DataTypes::URL);

    return (string) $sanitize->data();
  }

  /**
   * Get the domain extension.
   *
   * @return string
   *   The extension of the domain.
   */
  public static function getDomainExtension(): string {
    $host_parts = explode('.', self::requestStatic()->server->get(ServerOptions::HTTP_HOST));

    return end($host_parts) ?? 'nl';
  }

}
