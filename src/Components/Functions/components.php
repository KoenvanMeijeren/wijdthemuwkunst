<?php

use Components\Env\Env;
use Components\Env\EnvInterface;
use Components\Header\Header;
use Components\Header\HeaderInterface;
use Components\SuperGlobals\Request;
use Components\SuperGlobals\RequestInterface;
use Components\SuperGlobals\Session\Session;
use Components\SuperGlobals\Session\SessionInterface;
use Domain\Admin\Accounts\User\Models\User;
use JetBrains\PhpStorm\Pure;

/**
 * Gets the request definition.
 *
 * @return RequestInterface
 *   The request definition.
 */
#[Pure] function request(): RequestInterface {
  return new Request();
}

/**
 * Gets the session definition.
 *
 * @return SessionInterface
 *   The session definition.
 */
function session(): SessionInterface {
  return new Session();
}

/**
 * Gets the env definition.
 *
 * @return EnvInterface
 *   The env definition.
 */
function environment(): EnvInterface {
  return new Env();
}

/**
 * Gets the header definition.
 *
 * @return HeaderInterface
 *   The env definition.
 */
#[Pure] function header_send(): HeaderInterface {
  return new Header();
}

/**
 * Gets the user definition.
 *
 * @return User
 *   The user definition.
 */
function current_user(): User {
  return new User();
}
