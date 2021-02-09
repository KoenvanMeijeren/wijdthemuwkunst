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
 *   The request object.
 */
#[Pure] function request(): RequestInterface {
  return new Request();
}

/**
 * Gets the session definition.
 *
 * @return SessionInterface
 *   The session object.
 */
function session(): SessionInterface {
  return new Session();
}

/**
 * Gets the env object.
 *
 * @return EnvInterface
 *   The env object.
 */
function env(): EnvInterface {
  return new Env();
}

/**
 * Gets the header object.
 *
 * @return HeaderInterface
 *   The env object.
 */
#[Pure] function headerSend(): HeaderInterface {
  return new Header();
}

/**
 * Gets the user object.
 *
 * @return User
 *   The user object.
 */
function user(): User {
  return new User();
}
