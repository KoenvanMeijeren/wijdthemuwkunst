<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Cookie;

use Components\Array\ArrayBase;
use Components\Sanitize\Sanitize;
use Components\Encrypt\Encrypt;

/**
 * Provides a class for interacting with cookies.
 *
 * @package src\Core
 */
final class Cookie extends ArrayBase implements CookieInterface {

  /**
   * Constructs the cookie.
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
  ) {
    parent::__construct($_COOKIE, true, true);
  }

  /**
   * {@inheritDoc}
   */
  public function save(string $key, string $value): void {
    if ($this->exists($key)) {
      return;
    }

    $sanitize = new Sanitize($value);
    $data = new Encrypt((string) $sanitize->data());

    setcookie($key, $data->encrypt(), time() + $this->expiringTime, $this->path, $this->domain, $this->secure, $this->httpOnly);

    parent::save($key, $value);
  }

  /**
   * {@inheritDoc}
   */
  public function unset(string $key): bool {
    if (!$this->exists($key)) {
      return false;
    }

    setcookie($key, '', time() - $this->expiringTime, $this->path, $this->domain, $this->secure, $this->httpOnly);

    return parent::unset($key);
  }

}
