<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Session;

use Components\Array\ArrayBaseInterface;

/**
 * Provides an interfaces for classes which are interacting with the session.
 *
 * @package src\Session
 */
interface SessionInterface extends ArrayBaseInterface {

  /**
   * Saves data in the session.
   *
   * @param string $key
   *   The key of the session item.
   * @param string $value
   *   The value of the key.
   */
  public function save(string $key, string $value): void;

  /**
   * Forced saving data in the session.
   *
   * @param string $key
   *   The key of the session item.
   * @param string $value
   *   The value of the key.
   */
  public function saveForced(string $key, string $value): void;

  /**
   * Flashes data in the session.
   *
   * @param string $key
   *   The key of the session item.
   * @param string $value
   *   The value of the key.
   */
  public function flash(string $key, string $value): void;

  /**
   * Gets data from the session; unset the data if specified.
   *
   * @param string $key
   *   The key for searching to the corresponding session value.
   * @param bool $unset
   *   Must the session value be destroyed?
   *
   * @return string|null
   *   The value of the session item.
   */
  public function get(string $key, bool $unset = FALSE): ?string;

}
