<?php

declare(strict_types=1);


namespace Src\Session;

use Src\Core\Request;
use Src\Core\Sanitize;
use Src\Core\URI;
use Src\Log\Log;
use Src\Security\Encrypt;
use Src\State\State;

/**
 *
 */
final class Session {

  /**
   * Save data in the session.
   *
   * @param string $key
   *   the key of the session item.
   * @param string $value
   *   the value of the key.
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
   * Forced save of data in the session.
   *
   * @param string $key
   *   the key of the session item.
   * @param string $value
   *   the value of the key.
   */
  public function saveForced(string $key, string $value): void {
    $sanitize = new Sanitize($value);
    $data = new Encrypt((string) $sanitize->data());
    $_SESSION[$key] = $data->encrypt();
  }

  /**
   * Flash data in the session.
   *
   * @param string $key
   *   the key of the session item.
   * @param string $value
   *   the value of the key.
   */
  public function flash(string $key, string $value): void {
    $this->saveForced($key, $value);

    $this->logRequest($key, $value);
  }

  /**
   * Get data from the session; unset the data if specified.
   *
   * @param string $key
   *   the key for searching to the
   *   corresponding session value.
   * @param bool $unset
   *   Must the session value be destroyed?
   *
   * @return string
   */
  public function get(string $key, bool $unset = FALSE): string {
    $request = new Request();
    $data = $request->session($key);
    if ($data === '') {
      return '';
    }

    if (isJson($data)) {
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
   * Check if the given key exists in the super global array.
   *
   * @param string $key
   *   the key to be checked for if it exists.
   *
   * @return bool
   */
  public function exists(string $key): bool {
    if (array_key_exists($key, $_SESSION)) {
      return TRUE;
    }

    return FALSE;
  }

  /**
   * Unset data from the session.
   *
   * @param string $key
   *   the key for searching to the
   *   corresponding session value
   *                    to unset it.
   *
   * @return bool
   */
  public function unset(string $key): bool {
    if (array_key_exists($key, $_SESSION)) {
      unset($_SESSION[$key]);

      return TRUE;
    }

    return FALSE;
  }

  /**
   * Log a session request when the key is of the type
   * of state failed or state successful.
   *
   * @param string $key
   * @param string $value
   */
  public function logRequest(string $key, string $value): void {
    if ($key !== State::FAILED
          && $key !== State::SUCCESSFUL
          && $key !== State::FORM_VALIDATION_FAILED
      ) {
      return;
    }

    Log::appRequest(
          $value,
          $key,
          URI::getUrl(),
          URI::getMethod()
      );
  }

}
