<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Session;

use Components\Array\ArrayBase;
use Components\ComponentsTrait;
use Components\Sanitize\Sanitize;
use Src\Log\LoggerTrait;
use Components\Encrypt\Encrypt;

/**
 * Defines a class for interacting with the session.
 *
 * @package src\Session
 */
final class Session extends ArrayBase implements SessionInterface {

  use LoggerTrait;
  use ComponentsTrait;

  /**
   * Session constructor.
   */
  public function __construct() {
    parent::__construct($_SESSION ?? []);
  }

  /**
   * {@inheritDoc}
   */
  public function save(string $key, string $value): void {
    if ($this->exists($key)) {
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
    $data = $this->request()->session($key);
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

}
