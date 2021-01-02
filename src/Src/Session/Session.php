<?php

declare(strict_types=1);


namespace Src\Session;

use Src\Core\Request;
use Src\Core\Sanitize;
use Src\Log\LoggerTrait;
use Src\Security\Encrypt;

/**
 * Defines a class for interacting with the session.
 *
 * @package src\Session
 */
final class Session implements SessionInterface {

  use LoggerTrait;

  /**
   * {@inheritDoc}
   */
  public function save(string $key, string $value): void {
    if (array_key_exists($key, $_SESSION)) {
      return;
    }

    $sanitize = new Sanitize($value);
    $data = new Encrypt((string) $sanitize->data());
    $_SESSION[$key] = $data->encrypt();
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

    $this->logRequest($key, $value);
  }

  /**
   * {@inheritDoc}
   */
  public function get(string $key, bool $unset = FALSE): ?string {
    $request = new Request();
    $data = $request->session($key);
    if ($data === '') {
      return NULL;
    }

    if (is_json($data)) {
      return $data;
    }

    if ($unset) {
      $this->unset($key);
    }

    $sanitize = new Sanitize($data);
    $data = new Encrypt((string) $sanitize->data());

    return $data->decrypt();
  }

  /**
   * {@inheritDoc}
   */
  public function exists(string $key): bool {
    return array_key_exists($key, $_SESSION);
  }

  /**
   * {@inheritDoc}
   */
  public function unset(string $key): bool {
    if (array_key_exists($key, $_SESSION)) {
      unset($_SESSION[$key]);

      return TRUE;
    }

    return FALSE;
  }

}
