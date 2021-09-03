<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Session;

use Components\Array\ArrayBase;
use Components\ComponentsTrait;
use Components\Encrypt\Encrypt;
use Components\Sanitize\Sanitize;

/**
 * Defines a class for interacting with the session.
 *
 * @package src\Session
 */
final class Session extends ArrayBase implements SessionInterface {

  use ComponentsTrait;

  /**
   * Session constructor.
   */
  public function __construct() {
    parent::__construct($_SESSION, true, true);
  }

  /**
   * {@inheritDoc}
   */
  public function saveForced(string $key, string $value): void {
    $sanitize = new Sanitize($value);
    $data = new Encrypt((string) $sanitize->data());
    $_SESSION[$key] = $data->encrypt();
  }

  /**
   * {@inheritDoc}
   */
  public function flash(string $key, string $value): void {
    $this->saveForced($key, $value);

    $this->logger()->logRequest($key, $value);
  }

}
