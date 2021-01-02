<?php

namespace Src\Session;

/**
 * Provides an interfaces for the security of the session.
 *
 * @package src\Session
 */
interface SessionSecurityInterface {

  /**
   * Binds the user agent to the session to prevent hijacking.
   */
  public function userAgentProtection(): void;

  /**
   * Binds the remote ip to the session to prevent hijacking.
   */
  public function remoteIpProtection(): void;

}
