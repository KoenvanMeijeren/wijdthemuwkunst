<?php
declare(strict_types=1);

namespace Components;

use Components\SuperGlobals\Request;
use Components\SuperGlobals\RequestInterface;
use Components\SuperGlobals\Session\Session;
use Components\SuperGlobals\Session\SessionInterface;
use JetBrains\PhpStorm\Pure;

/**
 * Provides a trait for interacting with the components.
 *
 * @package Components
 */
trait ComponentsTrait {

  /**
   * Gets the request object.
   *
   * @return RequestInterface
   *   The request object.
   */
  #[Pure]
  protected function request(): RequestInterface {
    return new Request();
  }

  /**
   * Gets the session object.
   *
   * @return SessionInterface
   *   The session object.
   */
  protected function session(): SessionInterface {
    return new Session();
  }

}
