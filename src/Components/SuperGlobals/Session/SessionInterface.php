<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Session;

use Components\Collection\CollectionStringBaseInterface;

/**
 * Provides an interfaces for classes which are interacting with the session.
 *
 * @package src\Session
 */
interface SessionInterface extends CollectionStringBaseInterface {

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

}
