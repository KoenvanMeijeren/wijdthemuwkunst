<?php
declare(strict_types=1);

namespace Src\Core;

use Src\Security\Encrypt;

/**
 * Provides a class for interacting with cookies.
 *
 * @package src\Core
 */
final class Cookie {

  /**
   * Construct the cookie.
   *
   * @param int $expiringTime
   *   The expiring time of the cookie.
   * @param string $path
   *   The path of the cookie.
   * @param string $domain
   *   The domain of the cookie.
   * @param bool $secure
   *   Determine if the cookie must be secure.
   * @param bool $httpOnly
   *   Determine if the cookie must be http only.
   */
  public function __construct(
    private int $expiringTime = 1 * 24 * 60 * 60,
    private string $path = '/',
    private string $domain = '',
    private bool $secure = FALSE,
    private bool $httpOnly = TRUE
  ) {}

  /**
   * Save data in the cookie.
   *
   * @param string $key
   *   The key of the cookie item.
   * @param string $value
   *   The value of the key.
   */
  public function save(string $key, string $value): void {
    if ($this->exists($key)) {
      return;
    }

    $sanitize = new Sanitize($value);
    $data = new Encrypt((string) $sanitize->data());

    setcookie($key, $data->encrypt(), time() + $this->expiringTime, $this->path, $this->domain, $this->secure, $this->httpOnly);
  }

  /**
   * Check if the given key exists in the super global array.
   *
   * @param string $key
   *   The key to be checked for if it exists.
   *
   * @return bool
   *   Whether the key exists or not.
   */
  public function exists(string $key): bool {
    return isset($_COOKIE[$key]);
  }

  /**
   * Get data from the cookie; unset it if specified.
   *
   * @param string $key
   *   the key for searching to the
   *   corresponding cookie value.
   * @param string $default
   *   the default value to be returned when
   *   the given key does not exists.
   *
   * @return string
   */
  public function get(string $key, string $default = ''): string {
    $request = new Request();
    if ($request->cookie($key) === '') {
      return $default;
    }

    $sanitize = new Sanitize($request->cookie($key));
    $data = new Encrypt((string) $sanitize->data());

    return $data->decrypt();
  }

  /**
   * Unsets a cookie.
   *
   * @param string $key
   *   The key of the cookie.
   */
  public function unset(string $key): void {
    if (!$this->exists($key)) {
      return;
    }

    setcookie($key, '', time() - $this->expiringTime, $this->path, $this->domain, $this->secure, $this->httpOnly);
    unset($_COOKIE[$key]);
  }

}
