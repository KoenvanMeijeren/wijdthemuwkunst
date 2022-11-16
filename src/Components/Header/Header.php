<?php
declare(strict_types=1);

namespace Components\Header;

use Components\Sanitize\DataTypes;
use Components\Sanitize\Sanitize;
use JetBrains\PhpStorm\NoReturn;

/**
 * Provides a class for interacting with the headers.
 *
 * @package Components\Header
 */
final class Header implements HeaderInterface {

  /**
   * {@inheritDoc}
   */
  public function send(string $header, bool $replace = TRUE, int $response_code = self::DEFAULT_RESPONSE_CODE): void {
    header($header, $replace, $response_code);
  }

  /**
   * {@inheritDoc}
   */
  #[NoReturn] public function redirect(string $url): never {
    header('Location: ' . $url);
    exit();
  }

  /**
   * {@inheritDoc}
   */
  public function refresh(string $url, int $refreshTime): void {
    $sanitize = new Sanitize($url, DataTypes::URL);

    header("Refresh: {$refreshTime}; URL=/" . $sanitize->data());
  }

  /**
   * {@inheritDoc}
   */
  public function accessDenied(): never {
    header('HTTP/1.1 403 Origin Denied');
    exit();
  }

  /**
   * {@inheritDoc}
   */
  public function allowOrigin(string $origin): void {
    header("Access-Control-Allow-Origin: {$origin}");
  }

  /**
   * {@inheritDoc}
   */
  public function remove(string $name): void {
    header_remove($name);
  }

}
