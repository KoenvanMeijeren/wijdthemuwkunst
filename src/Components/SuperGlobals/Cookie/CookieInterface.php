<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Cookie;

use Components\Collection\CollectionStringBaseInterface;

/**
 * Provides an interface for interacting with cookies.
 *
 * @package Components\SuperGlobals\Cookie
 */
interface CookieInterface extends CollectionStringBaseInterface {

  /**
   * Save data in the cookie.
   *
   * @param string $key
   *   The key of the cookie item.
   * @param string $value
   *   The value of the key.
   */
  public function save(string $key, string $value): void;

}
