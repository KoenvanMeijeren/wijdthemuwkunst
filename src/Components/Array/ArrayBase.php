<?php
declare(strict_types=1);

namespace Components\Array;

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
