<?php

declare(strict_types=1);


namespace Src\Session;

use Cake\Chronos\Chronos;
use Src\Core\Cookie;
use Src\Core\Env;
use Src\Exceptions\Session\InvalidSessionException;
use Src\Session\SessionSecurity as SessionSecurity;

/**
 * Class Builder.
 *
 * @package Src\Session
 */
final class SessionBuilder {

  /**
   * The session definition.
   *
   * @var Session
   */
  private Session $session;

  /**
   * The session security definition.
   *
   * @var \Src\Session\SessionSecurity
   */
  private SessionSecurity $security;

  /**
   * The name of the session.
   *
   * @var string
   */
  private string $name;

  /**
   * The path of the session.
   *
   * @var string
   */
  private string $path;

  /**
   * The domain of the session.
   *
   * @var string
   */
  private string $domain;

  /**
   * The expiring time of the session.
   *
   * @var float|int
   */
  private int $expiringTime;

  /**
   * Determine if the session must be secure.
   *
   * @var bool
   */
  private bool $secure;

  /**
   * Determine if the session must be http only.
   *
   * @var bool
   */
  private bool $httpOnly;

  /**
   * Construct the session.
   *
   * @param int $expiringTime
   *   The expiring time of the session.
   * @param string $path
   *   The path of the session.
   * @param string $domain
   *   The domain of the session.
   * @param bool $secure
   *   Determine if the session must be secure.
   * @param bool $httpOnly
   *   Determine if the session must be http only.
   *
   * @throws \Exception
   */
  public function __construct(
    int $expiringTime = 1 * 4 * 60 * 60,
    string $path = '/',
    string $domain = '',
    bool $secure = FALSE,
    bool $httpOnly = TRUE
  ) {
    $this->name = random_string(128);
    $this->expiringTime = $expiringTime;
    $this->path = $path;
    $this->domain = $domain;
    $this->secure = $secure;
    $this->httpOnly = $httpOnly;

    $this->session = new Session();
    $this->security = new SessionSecurity();
  }

  /**
   * Start the session.
   */
  public function startSession(string $env = Env::PRODUCTION): void {
    if ($env === Env::PRODUCTION) {
      $this->secure = TRUE;
    }

    if (PHP_SESSION_NONE === session_status() && !headers_sent()) {
      $this->setSessionName();

      session_name($this->getSessionName());

      session_set_cookie_params(
      // Lifetime -- 0 means erase when browser closes.
        $this->expiringTime,
        // Which paths are these cookies relevant?
        $this->path,
        // Only expose this to which domain?
        $this->domain,
        // Only send over the network when TLS is used.
        $this->secure,
        // Don't expose to Javascript.
        $this->httpOnly
      );

      session_start();
    }
  }

  /**
   * Set some security options for the session.
   */
  public function setSessionSecurity(): void {
    $this->security->userAgentProtection();
    $this->security->remoteIpProtection();
    $this->setExpiringSession();
    $this->setCanarySession();
  }

  /**
   * Set an unique unreadable session name.
   */
  private function setSessionName(): void {
    $cookie = new Cookie($this->expiringTime - 1);
    if ($cookie->exists('sessionName')) {
      return;
    }

    // Unset all session name cookies.
    foreach ($_COOKIE as $key => $value) {
      if (strlen($key) === strlen($this->name)) {
        $cookie->unset($key);
      }
    }

    $cookie->save('sessionName', $this->name);
  }

  /**
   * Get the session name.
   *
   * @return string
   *   The name of the session.
   */
  private function getSessionName(): string {
    $cookie = new Cookie();

    return $cookie->get('sessionName', $this->name);
  }

  /**
   * Set the expiring time for the session.
   */
  private function setExpiringSession(): void {
    $now = new Chronos();
    if ($this->session->get('createdAt') === '') {
      $this->session->saveForced('createdAt', $now->toDateTimeString());
    }

    $sessionCreatedAt = $this->session->get('createdAt');
    $expired = new Chronos($sessionCreatedAt);
    $expired = $expired->addSeconds($this->expiringTime);

    if ($expired->lte($now) && !headers_sent()) {
      $this->destroy();
    }
  }

  /**
   * Regenerate session ID every five minutes.
   */
  private function setCanarySession(): void {
    // Check if the session is not active.
    if (session_status() === PHP_SESSION_NONE) {
      return;
    }

    $canary = (int) $this->session->get('canary');
    // If the canary must be initialized.
    if ($canary === 0) {
      session_regenerate_id(TRUE);
      $this->session->saveForced('canary', (string) time());
    }

    // If the canary has been set earlier.
    if ($canary < (time() - 300)) {
      session_regenerate_id(TRUE);
      $this->session->saveForced('canary', (string) time());
    }
  }

  /**
   * Destroy the session.
   */
  public function destroy(): void {
    if (PHP_SESSION_ACTIVE !== session_status()) {
      throw new InvalidSessionException(
        'Cannot destroy the session if the session does not exists'
      );
    }

    $params = session_get_cookie_params();
    $cookie = new Cookie(
      42000,
      $params['path'] ?? '',
      $params['domain'] ?? '',
      $params['secure'] ?? FALSE,
      $params['httponly'] ?? TRUE
    );

    $cookie->unset(session_name());
    $cookie->unset('sessionName');

    session_unset();
    session_destroy();
  }

}
