<?php
declare(strict_types=1);

namespace Components\Array;

/**
 * Provides an interface for interacting with arrays.
 *
 * @package Components\Array
 */
interface ArrayBaseInterface {

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
