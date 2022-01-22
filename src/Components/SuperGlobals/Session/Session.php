<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Session;

use Components\Collection\CollectionStringBase;
use Components\ComponentsTrait;
use Components\Encrypt\Encrypt;
use Components\Sanitize\Sanitize;

/**
 * Defines a class for interacting with the session.
 *
 * @package src\Session
 */
final class Session extends CollectionStringBase implements SessionInterface {

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
  public function save(string $key, string $value): void {
    parent::save($key, $value);
    $_SESSION[$key] = $this->items[$key];
  }

  /**
   * {@inheritDoc}
   */
  public function saveForced(string $key, string $value): void {
    $sanitize = new Sanitize($value);
    $data = new Encrypt((string) $sanitize->data());
    $_SESSION[$key] = $data->encrypt();
    $this->items[$key] = $_SESSION[$key];
  }

  /**
   * {@inheritDoc}
   */
  public function flash(string $key, string $value): void {
    $this->saveForced($key, $value);

    $this->logger()->logRequest($key, $value);
  }

}
