<?php

declare(strict_types=1);


namespace Src\Session;

use Src\Core\Request;
use Src\Log\Log;

/**
 * Class Security.
 *
 * @package src\Session
 */
final class SessionSecurity implements SessionSecurityInterface {

  /**
   * The request definition.
   *
   * @var \Src\Core\Request
   */
  protected Request $request;

  /**
   * The session definition.
   *
   * @var Session
   */
  protected Session $session;

  /**
   * Construct the security.
   */
  public function __construct() {
    $this->request = new Request();
    $this->session = new Session();
  }

  /**
   * {@inheritDoc}
   */
  public function userAgentProtection(): void {
    $user_agent = $this->request->server(Request::HTTP_USER_AGENT);
    if (!$this->session->exists('user_agent')) {
      $this->session->saveForced('user_agent', $user_agent);
    }

    if ($this->session->get('user_agent') === $user_agent) {
      return;
    }

    Log::warning('Session hijacking attack has been declined');

    $session = new SessionBuilder();
    $session->destroy();

    $this->session->saveForced('user_agent', $user_agent);
  }

  /**
   * {@inheritDoc}
   */
  public function remoteIpProtection(): void {
    $user_ip = $this->request->server(Request::USER_IP_ADDRESS);
    if (!$this->session->exists('user_remote_ip')) {
      $this->session->saveForced('user_remote_ip', $user_ip);
    }

    if ($this->session->get('user_remote_ip') === $user_ip) {
      return;
    }

    log::warning('Session hijacking attack has been declined');

    $session = new SessionBuilder();
    $session->destroy();

    $this->session->saveForced('user_remote_ip', $user_ip);
  }

}
