<?php
declare(strict_types=1);

namespace Components\Collection;

/**
 * Provides an interface for interacting with arrays.
 *
 * @package \Components\Array
 */
interface CollectionStringBaseInterface {

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
  public function get(string $key, string $default = '', bool $unset = FALSE): ?string;

  /**
   * Returns all items of the array.
   *
   * @return array
   *   The items of the array.
   */
  public function all(): array;

  /**
   * Check if the given key exists in the array.
   *
   * @param string $key
   *   The key of the array item.
   *
   * @return bool
   *   If the array item does exists.
   */
  public function exists(string $key): bool;

  /**
   * Unset data from the array.
   *
   * @param string $key
   *   The key to search for.
   *
   * @return bool
   *   If the data is unset from the array.
   */
  public function unset(string $key): bool;

}
