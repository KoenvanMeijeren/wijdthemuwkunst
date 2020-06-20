<?php

declare(strict_types=1);


namespace Src\Session;

use Src\Core\Request;
use Src\Log\Log;

/**
 * Class Security.
 *
 * @package Src\Session
 */
final class Security {

  /**
   * The request definition.
   *
   * @var \Src\Core\Request
   */
  private Request $request;

  /**
   * The session definition.
   *
   * @var Session
   */
  private Session $session;

  /**
   * Construct the security.
   *
   * @throws \Exception
   */
  public function __construct() {
    $this->request = new Request();
    $this->session = new Session();
  }

  /**
   * Sets the user agent in the session to prevent hijacking.
   *
   * @throws \Exception
   */
  public function userAgentProtection(): void {
    $userAgent = $this->request->server(Request::HTTP_USER_AGENT);

    $this->session->saveForced('user_agent', $userAgent);
    if ($this->session->get('user_agent') !== $userAgent) {
      Log::warning(
            'Session hijacking attack has been declined'
        );

      $session = new Builder();
      $session->destroy();

      $this->session->saveForced('user_agent', $userAgent);
    }
  }

  /**
   * Sets the remote ip in the session to prevent hijacking.
   *
   * @throws \Exception
   */
  public function remoteIpProtection(): void {
    $userIP = $this->request->server(Request::USER_IP_ADDRESS);

    $this->session->saveForced('user_remote_ip', $userIP);
    if ($this->session->get('user_remote_ip') !== $userIP) {
      log::warning(
            'Session hijacking attack has been declined'
        );

      $session = new Builder();
      $session->destroy();

      $this->session->saveForced('user_remote_ip', $userIP);
    }
  }

}
