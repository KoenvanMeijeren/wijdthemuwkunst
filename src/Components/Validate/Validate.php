<?php
declare(strict_types=1);

namespace Components\Validate;

use Components\Env\Env;
use Components\Validate\Exceptions\Basic\InvalidTypeException;
use Components\File\Exceptions\FileNotFoundException;
use Components\File\Exceptions\FileNotOfResourceTypeException;
use Components\File\Exceptions\FileNotReadableException;
use Components\File\Exceptions\FileNotWritableException;
use Components\Validate\Exceptions\Object\InvalidMethodCalledException;
use Components\Validate\Exceptions\Object\InvalidObjectException;
use Components\Validate\Exceptions\Object\MethodNotCallableException;
use Components\SuperGlobals\Url\Exceptions\InvalidDomainException;
use Components\SuperGlobals\Url\Exceptions\InvalidEnvException;
use Components\SuperGlobals\Url\Exceptions\InvalidUriException;

/**
 * Provides a class for validation actions.
 *
 * @package src\Validate
 */
final class Validate implements ValidateInterface {

  /**
   * The var to be validated.
   *
   * @var mixed
   */
  protected static mixed $var;

  /**
   * Validate constructor.
   */
  protected function __construct() {}

  /**
   * {@inheritDoc}
   */
  public static function var(mixed $var): Validate {
    self::$var = $var;

    return new self();
  }

  /**
   * {@inheritDoc}
   */
  public function isScalar(): ValidateInterface {
    if (!is_scalar(self::$var)) {
      throw new InvalidTypeException(self::$var, 'scalar');
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isString(): ValidateInterface {
    if (!is_string(self::$var)) {
      throw new InvalidTypeException(self::$var, 'string');
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isInt(): ValidateInterface {
    if (!is_int(self::$var)) {
      throw new InvalidTypeException(self::$var, 'integer');
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isFloat(): ValidateInterface {
    if (!is_float(self::$var)) {
      throw new InvalidTypeException(self::$var, 'float');
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isNumeric(): ValidateInterface {
    if (!is_numeric(self::$var)) {
      throw new InvalidTypeException(self::$var, 'numeric');
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isCountable(): ValidateInterface {
    if (!is_countable(self::$var)) {
      throw new InvalidTypeException(self::$var, 'countable');
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isArray(): ValidateInterface {
    if (!is_array(self::$var)) {
      throw new InvalidTypeException(self::$var, 'array');
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isUrl(): ValidateInterface {
    if (filter_var(self::$var, FILTER_VALIDATE_URL) === FALSE) {
      throw new InvalidUriException(self::$var);
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isDomain(): ValidateInterface {
    if (self::$var !== 'localhost'
      && preg_match('/[a-zA-Z]{0,9}+[:][\d]{0,4}/', self::$var) === 0
      && preg_match('/(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]/', self::$var) === 0
    ) {
      throw new InvalidDomainException(self::$var);
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isEnv(): ValidateInterface {
    if (Env::DEVELOPMENT !== self::$var && Env::PRODUCTION !== self::$var) {
      throw new InvalidEnvException(self::$var);
    }

    return $this;
  }


  /**
   * {@inheritDoc}
   */
  public function isObject(): ValidateInterface {
    if (!is_object(self::$var)) {
      throw new InvalidObjectException(self::$var);
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function methodExists(string $method): ValidateInterface {
    if (!method_exists(self::$var, $method)) {
      throw new InvalidMethodCalledException($method, self::$var);
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isCallable(): ValidateInterface {
    if (!is_callable(self::$var)) {
      throw new MethodNotCallableException(self::$var);
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function fileExists(): ValidateInterface {
    if (file_exists(self::$var)) {
      return $this;
    }

    throw new FileNotFoundException(self::$var);
  }

  /**
   * {@inheritDoc}
   */
  public function isResource(): ValidateInterface {
    if (!is_resource(self::$var)) {
      throw new FileNotOfResourceTypeException(self::$var);
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isReadable(): ValidateInterface {
    if (!is_readable(self::$var)) {
      throw new FileNotReadableException(self::$var);
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isWritable(): ValidateInterface {
    if (!is_writable(self::$var)) {
      throw new FileNotWritableException(self::$var);
    }

    return $this;
  }

}
