<?php
declare(strict_types=1);

namespace Components\Header;

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
  public function send(string $header, bool $replace = TRUE, int $response_code = 0): void {
    header($header, $replace, $response_code);
  }

  /**
   * {@inheritDoc}
   */
  #[NoReturn] public function redirect(string $url): void {
    header('Location: ' . $url);
    exit();
  }

  /**
   * {@inheritDoc}
   */
  public function refresh(string $url, int $refreshTime): void {
    $sanitize = new Sanitize($url, Sanitize::TYPE_URL);

    header("Refresh: {$refreshTime}; URL=/" . $sanitize->data());
  }

  /**
   * {@inheritDoc}
   */
  public function remove(string $name): void {
    header_remove($name);
  }

}
