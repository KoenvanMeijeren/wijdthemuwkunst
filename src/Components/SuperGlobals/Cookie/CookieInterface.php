<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Cookie;

use Components\Array\ArrayBaseInterface;

/**
 * Provides an interface for interacting with cookies.
 *
 * @package Components\SuperGlobals\Cookie
 */
interface CookieInterface extends ArrayBaseInterface {

  /**
   * Save data in the cookie.
   *
   * @param string $key
   *   The key of the cookie item.
   * @param string $value
   *   The value of the key.
   */
  public function save(string $key, string $value): void;

  /**
   * Get data from the cookie; unset it if specified.
   *
   * @param string $key
   *   The key for searching to the
   *   corresponding cookie value.
   * @param string $default
   *   The default value to be returned when
   *   the given key does not exists.
   *
   * @return string
   */
  public function get(string $key, string $default = ''): string;

}
