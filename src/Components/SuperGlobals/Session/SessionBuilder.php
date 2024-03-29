<?php

declare(strict_types=1);


namespace Components\SuperGlobals\Session;

use Cake\Chronos\Chronos;
use Components\ComponentsTrait;
use Components\Env\Environments;
use Components\SuperGlobals\Cookie\Cookie;
use Components\SuperGlobals\Session\Exceptions\InvalidSessionException;

/**
 * Class Builder.
 *
 * @package src\Session
 */
final class SessionBuilder {

  use ComponentsTrait;

  /**
   * The name of the session.
   *
   * @var string
   */
  protected string $name;

  /**
   * Constructs the session.
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
   * @param \Components\SuperGlobals\Session\SessionSecurityInterface $security
   *   The session security definition.
   *
   * @throws \Exception
   */
  public function __construct(
    private int $expiringTime = 1 * 4 * 60 * 60,
    private string $path = '/',
    private string $domain = '',
    private bool $secure = FALSE,
    private bool $httpOnly = TRUE,
    protected SessionSecurityInterface $security = new SessionSecurity()
  ) {
    $this->name = random_string(128);
  }

  /**
   * Start the session.
   *
   * @param \Components\Env\Environments $env
   *   The environment of the application.
   */
  public function startSession(Environments $env): void {
    if (PHP_SESSION_NONE !== session_status() || headers_sent()) {
      return;
    }

    if ($env->isEqual(Environments::PRODUCTION)) {
      $this->secure = TRUE;
    }

    $this->setSessionName();
    session_name($this->getSessionName());

    session_set_cookie_params(
      // Lifetime -- 0 means erase when browser closes.
      lifetime_or_options: $this->expiringTime,
      // Which paths are these cookies relevant?
      path: $this->path,
      // Only expose this to which domain?
      domain: $this->domain,
      // Only send over the network when TLS is used.
      secure: $this->secure,
      // Don't expose to Javascript.
      httponly: $this->httpOnly
    );

    session_start();
  }

  /**
   * Set some security options for the session.
   */
  public function secureSession(): void {
    $this->security->userAgentProtection();
    $this->security->remoteIpProtection();
    $this->setExpiringSession();
    $this->setCanarySession();
  }

  /**
   * Set an unique unreadable session name.
   */
  protected function setSessionName(): void {
    $cookie = new Cookie(expiringTime: $this->expiringTime - 1);
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
  protected function getSessionName(): string {
    return $this->request()->cookie('sessionName', $this->name);
  }

  /**
   * Set the expiring time for the session.
   */
  protected function setExpiringSession(): void {
    $now = new Chronos();
    if ($this->session()->get('createdAt') === '') {
      $this->session()->saveForced('createdAt', $now->toDateTimeString());
    }

    $sessionCreatedAt = $this->session()->get('createdAt');
    $expired = new Chronos($sessionCreatedAt);
    $expired = $expired->addSeconds($this->expiringTime);

    if ($expired->lte($now) && !headers_sent()) {
      $this->destroy();
    }
  }

  /**
   * Regenerates the session ID every five minutes.
   */
  protected function setCanarySession(): void {
    // Check if the session is not active.
    if (session_status() === PHP_SESSION_NONE) {
      return;
    }

    $canary = (int) $this->session()->get('canary');
    // The canary must be initialized.
    if ($canary === 0) {
      session_regenerate_id(TRUE);
      $this->session()->saveForced('canary', (string) time());
    }

    // If the canary has been set earlier.
    if ($canary < (time() - 300)) {
      session_regenerate_id(TRUE);
      $this->session()->saveForced('canary', (string) time());
    }
  }

  /**
   * Destroy the session.
   */
  public function destroy(): void {
    if (PHP_SESSION_ACTIVE !== session_status()) {
      throw new InvalidSessionException();
    }

    $params = session_get_cookie_params();
    $cookie = new Cookie(42000, $params['path'] ?? '', $params['domain'] ?? '', $params['secure'] ?? FALSE, $params['httponly'] ?? TRUE);

    $cookie->unset(session_name());
    $cookie->unset('sessionName');

    session_unset();
    session_destroy();
  }

}
