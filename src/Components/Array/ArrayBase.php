<?php
declare(strict_types=1);

namespace Components\Array;

use Components\Encrypt\Encrypt;
use Components\Sanitize\Sanitize;

/**
 * Provides a class for interacting with arrays.
 *
 * @package Components\Array
 */
abstract class ArrayBase implements ArrayBaseInterface {

  /**
   * ArrayBase constructor.
   *
   * @param array $array
   *   The array to interact with.
   * @param bool $sanitize
   *   Whether the data must be sanitized or not.
   * @param bool $encrypt
   *   Whether the data must be encrypted or not.
   */
  protected function __construct(
    private array &$array,
    private bool $sanitize = false,
    private bool $encrypt = false
  ) {}

  /**
   * {@inheritDoc}
   */
  public function save(string $key, string $value): void {
    if ($this->exists($key)) {
      return;
    }

    $data = $value;
    if ($this->sanitize) {
      $sanitize = new Sanitize($value);
      $data = $sanitize->data();
    }

    if (!$this->encrypt) {
      $this->array[$key] = $data;
      return;
    }

    $data = new Encrypt($data);
    $this->array[$key] = $data->encrypt();
  }

  /**
   * {@inheritDoc}
   */
  public function get(string $key, string $default = '', bool $unset = FALSE): string {
    if (!$this->exists($key)) {
      return $default;
    }

    $data = $this->array[$key];
    if ($data === '') {
      return $default;
    }

    if (is_json($data)) {
      return $data;
    }

    if ($unset) {
      $this->unset($key);
    }

    if ($this->sanitize) {
      $sanitize = new Sanitize($data);
      $data = $sanitize->data();
    }

    if (!$this->encrypt) {
      return $data;
    }

    $data = new Encrypt($data);
    return $data->decrypt();
  }

  /**
   * {@inheritDoc}
   */
  public function all(): array {
    return $this->array;
  }

  /**
   * {@inheritDoc}
   */
  public function exists(string $key): bool {
    return isset($this->array[$key]);
  }

  /**
   * {@inheritDoc}
   */
  public function unset(string $key): bool {
    if ($this->exists($key)) {
      unset($this->array[$key]);

      return TRUE;
    }

    return FALSE;
  }

}
