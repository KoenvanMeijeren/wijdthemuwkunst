<?php
declare(strict_types=1);

namespace Components;

use Components\Env\Env;
use Components\Env\EnvInterface;
use Components\Header\Header;
use Components\Header\HeaderInterface;
use Components\SuperGlobals\Request;
use Components\SuperGlobals\RequestInterface;
use Components\SuperGlobals\Session\Session;
use Components\SuperGlobals\Session\SessionInterface;

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
  protected function request(): RequestInterface {
    return $this->request ??= new Request();
  }

  /**
   * Gets the session object.
   *
   * @return SessionInterface
   *   The session object.
   */
  protected function session(): SessionInterface {
    return $this->session ??= new Session();
  }

  /**
   * Gets the env object.
   *
   * @return EnvInterface
   *   The env object.
   */
  protected function env(): EnvInterface {
    return $this->env ??= new Env();
  }

  /**
   * Gets the header object.
   *
   * @return HeaderInterface
   *   The env object.
   */
  protected function header(): HeaderInterface {
    return $this->header ??= new Header();
  }

}
