<?php
declare(strict_types=1);

namespace Components\Validate;

use Components\Env\Env;
use Components\Exceptions\Basic\InvalidTypeException;
use Components\File\Exceptions\FileNotFoundException;
use Components\File\Exceptions\FileNotOfResourceTypeException;
use Components\File\Exceptions\FileNotReadableException;
use Components\File\Exceptions\FileNotWritableException;
use Components\Exceptions\Object\InvalidMethodCalledException;
use Components\Exceptions\Object\InvalidObjectException;
use Components\Exceptions\Object\MethodNotCallableException;
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
  protected static $var;

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
   * Check the variable if it is a scalar type.
   *
   * @return Validate
   *
   * @throws \Components\Exceptions\Basic\InvalidTypeException
   */
  public function isScalar(): Validate {
    if (!is_scalar(self::$var)) {
      throw new InvalidTypeException(
        gettype(self::$var) . ' given. The variable must be a scalar type.'
      );
    }

    return $this;
  }

  /**
   * Check the variable if it is a string.
   *
   * @return Validate
   *
   * @throws \Components\Exceptions\Basic\InvalidTypeException
   */
  public function isString(): Validate {
    if (!is_string(self::$var)) {
      throw new InvalidTypeException(
        gettype(self::$var) . ' given. The variable must be a string.'
      );
    }

    return $this;
  }

  /**
   * Check the variable if it is an int.
   *
   * @return Validate
   *
   * @throws \Components\Exceptions\Basic\InvalidTypeException
   */
  public function isInt(): Validate {
    if (!is_int(self::$var)) {
      throw new InvalidTypeException(
        gettype(self::$var) . ' given. The variable must be an int.'
      );
    }

    return $this;
  }

  /**
   * Check the variable if it is an int.
   *
   * @return Validate
   *
   * @throws \Components\Exceptions\Basic\InvalidTypeException
   */
  public function isFloat(): Validate {
    if (!is_float(self::$var)) {
      throw new InvalidTypeException(
        gettype(self::$var) . ' given. The variable must be a float.'
      );
    }

    return $this;
  }

  /**
   * Check the variable if it is numeric.
   *
   * @return Validate
   *
   * @throws \Components\Exceptions\Basic\InvalidTypeException
   */
  public function isNumeric(): Validate {
    if (!is_numeric(self::$var)) {
      throw new InvalidTypeException(
        gettype(self::$var) . ' given. The variable must be numeric.'
      );
    }

    return $this;
  }

  /**
   * Check the variable if it is countable.
   *
   * @return Validate
   *
   * @throws \Components\Exceptions\Basic\InvalidTypeException
   */
  public function isCountable(): Validate {
    if (!is_countable(self::$var)) {
      throw new InvalidTypeException(
        gettype(self::$var) . ' given. The variable must be countable.'
      );
    }

    return $this;
  }

  /**
   * Check the variable if it is an array.
   *
   * @return Validate
   *
   * @throws \Components\Exceptions\Basic\InvalidTypeException
   */
  public function isArray(): Validate {
    if (!is_array(self::$var)) {
      throw new InvalidTypeException(
        gettype(self::$var) . ' given. The variable must be an array.'
      );
    }

    return $this;
  }

  /**
   * Checks the variable if it is an url.
   *
   * @return Validate
   *   The validate object reference.
   */
  public function isUrl(): Validate {
    if (filter_var(self::$var, FILTER_VALIDATE_URL) === FALSE) {
      throw new InvalidUriException(self::$var);
    }

    return $this;
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
      throw new InvalidDomainException(self::$var);
    }

    return $this;
  }

  /**
   * Check if the variable is of the type of an env.
   *
   * @return Validate
   *   The validate object reference.
   */
  public function isEnv(): Validate {
    if (Env::DEVELOPMENT !== self::$var && Env::PRODUCTION !== self::$var) {
      throw new InvalidEnvException(self::$var);
    }

    return $this;
  }


  /**
   * Check the variable if it is an object.
   *
   * @return Validate
   *
   * @throws \Components\Exceptions\Object\InvalidObjectException
   */
  public function isObject(): Validate {
    if (!is_object(self::$var)) {
      throw new InvalidObjectException(
        gettype(self::$var) .
        ' given. The variable must be an object.'
      );
    }

    return $this;
  }

  /**
   * Check if the method exists in the object.
   *
   * @param string $methodName
   *   the method to check.
   *
   * @return Validate
   *
   * @throws \Components\Exceptions\Object\InvalidMethodCalledException
   */
  public function methodExists(string $methodName): Validate {
    if (!method_exists(self::$var, $methodName)) {
      throw new InvalidMethodCalledException(
        "The called method {$methodName} does not exist in the object " . serialize(self::$var) . '.'
      );
    }

    return $this;
  }

  /**
   * Check if a function is callable.
   *
   * @return Validate
   *
   * @throws \Components\Exceptions\Object\MethodNotCallableException
   */
  public function isCallable(): Validate {
    if (!is_callable(self::$var)) {
      throw new MethodNotCallableException(
        'The called method does not exist: ' .
        serialize(self::$var) . '.'
      );
    }

    return $this;
  }

  /**
   * Check if the file exists.
   *
   * @return Validate
   *
   * @throws \Components\File\Exceptions\FileNotFoundException
   */
  public function fileExists(): Validate {
    if (file_exists(self::$var)) {
      return $this;
    }

    throw new FileNotFoundException(self::$var);
  }

  /**
   * Check if the file is a resource.
   *
   * @return Validate
   *
   * @throws \Components\File\Exceptions\FileNotOfResourceTypeException
   */
  public function isResource(): Validate {
    if (!is_resource(self::$var)) {
      throw new FileNotOfResourceTypeException(self::$var);
    }

    return $this;
  }

  /**
   * Check if the file is readable.
   *
   * @return Validate
   *
   * @throws \Components\File\Exceptions\FileNotReadableException
   */
  public function isReadable(): Validate {
    if (!is_readable(self::$var)) {
      throw new FileNotReadableException(
        'The file must be readable: ' . self::$var
      );
    }

    return $this;
  }

  /**
   * Check if the file is writable.
   *
   * @return Validate
   *
   * @throws \Components\File\Exceptions\FileNotWritableException
   */
  public function isWritable(): Validate {
    if (!is_writable(self::$var)) {
      throw new FileNotWritableException(
        'The file must be writable: ' . self::$var
      );
    }

    return $this;
  }

}
