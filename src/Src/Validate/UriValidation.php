<?php
declare(strict_types=1);

namespace Src\Validate;

use Src\Core\Env;
use Src\Exceptions\Uri\InvalidDomainException;
use Src\Exceptions\Uri\InvalidEnvException;
use Src\Exceptions\Uri\InvalidUriException;

/**
 * Provides a trait for uri validation actions.
 *
 * @package src\Validate
 */
trait UriValidation {

  /**
   * Checks the variable if it is an url.
   *
   * @return Validate
   *   The validate object reference.
   */
  public function isUrl(): Validate {
    if (filter_var(self::$var, FILTER_VALIDATE_URL) === FALSE) {
      throw new InvalidUriException('Invalid url given.');
    }

    return new Validate();
  }

  /**
   * Checks if the variable is a domain.
   *
   * @return Validate
   *   The validate object reference.
   */
  public function isDomain(): Validate {
    if (self::$var !== 'localhost'
      && preg_match('/[a-zA-Z]{0,9}+[:][\d]{0,4}/', self::$var) === 0
      && preg_match('/(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]/', self::$var) === 0
    ) {
      throw new InvalidDomainException('Invalid domain: ' . self::$var . ' given.');
    }

    return new Validate();
  }

  /**
   * Check if the variable is of the type of an env.
   *
   * @return Validate
   *   The validate object reference.
   */
  public function isEnv(): Validate {
    if (Env::DEVELOPMENT !== self::$var && Env::PRODUCTION !== self::$var) {
      throw new InvalidEnvException('Invalid environment given.');
    }

    return new Validate();
  }

}
