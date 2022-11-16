<?php
declare(strict_types=1);

namespace Components\Collection;

/**
 * Provides an interface for interacting with arrays.
 *
 * @package \Components\Array
 */
interface CollectionStringInterface extends CollectionInterface {

  /**
   * Saves data in the array.
   *
   * @param string $key
   *   The key of the array item.
   * @param string $value
   *   The value of the key.
   */
  public function save(string $key, string $value): void;

  /**
   * Gets data from the array; unset the data if specified.
   *
   * @param string $key
   *   The key for searching to the corresponding array value.
   * @param string $default
   *   The value to be returned if the key does not exists.
   * @param bool $unset
   *   Must the array value be destroyed?
   *
   * @return string|null
   *   The value of the array item.
   */
  public function get(string $key, mixed $default = '', bool $unset = FALSE): ?string;

}
