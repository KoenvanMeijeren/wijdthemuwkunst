<?php

declare(strict_types=1);

namespace Src\Validate;

use Src\Exceptions\Basic\InvalidTypeException;

/**
 * Provides a trait for uri validation actions.
 *
 * @package src\Validate
 */
trait BasicValidation {

  /**
   * Check the variable if it is a scalar type.
   *
   * @return Validate
   *
   * @throws \Src\Exceptions\Basic\InvalidTypeException
   */
  public function isScalar(): Validate {
    if (!is_scalar(self::$var)) {
      throw new InvalidTypeException(
            gettype(self::$var) . ' given. The variable must be a scalar type.'
        );
    }

    return new Validate();
  }

  /**
   * Check the variable if it is a string.
   *
   * @return Validate
   *
   * @throws \Src\Exceptions\Basic\InvalidTypeException
   */
  public function isString(): Validate {
    if (!is_string(self::$var)) {
      throw new InvalidTypeException(
            gettype(self::$var) . ' given. The variable must be a string.'
        );
    }

    return new Validate();
  }

  /**
   * Check the variable if it is an int.
   *
   * @return Validate
   *
   * @throws \Src\Exceptions\Basic\InvalidTypeException
   */
  public function isInt(): Validate {
    if (!is_int(self::$var)) {
      throw new InvalidTypeException(
            gettype(self::$var) . ' given. The variable must be an int.'
        );
    }

    return new Validate();
  }

  /**
   * Check the variable if it is an int.
   *
   * @return Validate
   *
   * @throws \Src\Exceptions\Basic\InvalidTypeException
   */
  public function isFloat(): Validate {
    if (!is_float(self::$var)) {
      throw new InvalidTypeException(
            gettype(self::$var) . ' given. The variable must be a float.'
        );
    }

    return new Validate();
  }

  /**
   * Check the variable if it is numeric.
   *
   * @return Validate
   *
   * @throws \Src\Exceptions\Basic\InvalidTypeException
   */
  public function isNumeric(): Validate {
    if (!is_numeric(self::$var)) {
      throw new InvalidTypeException(
            gettype(self::$var) . ' given. The variable must be numeric.'
        );
    }

    return new Validate();
  }

  /**
   * Check the variable if it is countable.
   *
   * @return Validate
   *
   * @throws \Src\Exceptions\Basic\InvalidTypeException
   */
  public function isCountable(): Validate {
    if (!is_countable(self::$var)) {
      throw new InvalidTypeException(
            gettype(self::$var) . ' given. The variable must be countable.'
        );
    }

    return new Validate();
  }

  /**
   * Check the variable if it is an array.
   *
   * @return Validate
   *
   * @throws \Src\Exceptions\Basic\InvalidTypeException
   */
  public function isArray(): Validate {
    if (!is_array(self::$var)) {
      throw new InvalidTypeException(
            gettype(self::$var) . ' given. The variable must be an array.'
        );
    }

    return new Validate();
  }

}