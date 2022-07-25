<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Session;

use Components\ComponentsTrait;
use Components\SuperGlobals\ServerOptions;

/**
 * Provides a class for securing the session.
 *
 * @package src\Session
 */
final class SessionSecurity implements SessionSecurityInterface {

  use ComponentsTrait;

  /**
   * {@inheritDoc}
   */
  public function userAgentProtection(): void {
    $user_agent = $this->request()->server->get(ServerOptions::HTTP_USER_AGENT);
    if (!$this->session()->exists('user_agent')) {
      $this->session()->saveForced('user_agent', $user_agent);
    }

    if ($this->session()->get('user_agent') === $user_agent) {
      return;
    }


    $this->log()->warning('Session hijacking attack has been declined');

    $session = new SessionBuilder();
    $session->destroy();

    $this->session()->saveForced('user_agent', $user_agent);
  }

  /**
   * {@inheritDoc}
   */
  public function remoteIpProtection(): void {
    $user_ip = $this->request()->server->get(ServerOptions::USER_IP_ADDRESS);
    if (!$this->session()->exists('user_remote_ip')) {
      $this->session()->saveForced('user_remote_ip', $user_ip);
    }

    if ($this->session()->get('user_remote_ip') === $user_ip) {
      return;
    }

    $this->log()->warning('Session hijacking attack has been declined');

    $session = new SessionBuilder();
    $session->destroy();

    $this->session()->saveForced('user_remote_ip', $user_ip);
  }

}
