<?php

namespace Components\Validate;


use Components\SuperGlobals\Url\Exceptions\InvalidDomainException;
use Components\SuperGlobals\Url\Exceptions\InvalidEnvException;
use Components\SuperGlobals\Url\Exceptions\InvalidUriException;

/**
 * Provides a class for validation actions.
 *
 * @package src\Validate
 */
interface ValidateInterface {

  /**
   * Sets the variable for validation.
   *
   * @param mixed $var
   *   The var to be validated.
   *
   * @return Validate
   *   The called object reference.
   */
  public static function var(mixed $var): Validate;

  /**
   * Checks the variable if it is a scalar type.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws \Components\Validate\Exceptions\Basic\InvalidTypeException
   */
  public function isScalar(): ValidateInterface;

  /**
   * Checks the variable if it is a string.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws \Components\Validate\Exceptions\Basic\InvalidTypeException
   */
  public function isString(): ValidateInterface;

  /**
   * Checks the variable if it is an int.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws \Components\Validate\Exceptions\Basic\InvalidTypeException
   */
  public function isInt(): ValidateInterface;

  /**
   * Checks the variable if it is an int.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws \Components\Validate\Exceptions\Basic\InvalidTypeException
   */
  public function isFloat(): ValidateInterface;

  /**
   * Checks the variable if it is numeric.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws \Components\Validate\Exceptions\Basic\InvalidTypeException
   */
  public function isNumeric(): ValidateInterface;

  /**
   * Checks the variable if it is countable.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws \Components\Validate\Exceptions\Basic\InvalidTypeException
   */
  public function isCountable(): ValidateInterface;

  /**
   * Checks the variable if it is an array.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws \Components\Validate\Exceptions\Basic\InvalidTypeException
   */
  public function isArray(): ValidateInterface;

  /**
   * Checks the variable if it is an url.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws InvalidUriException
   */
  public function isUrl(): ValidateInterface;

  /**
   * Checks if the variable is a domain.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws InvalidDomainException
   */
  public function isDomain(): ValidateInterface;

  /**
   * Check if the variable is of the type of an env.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws InvalidEnvException
   */
  public function isEnv(): ValidateInterface;

  /**
   * Check the variable if it is an object.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws \Components\Validate\Exceptions\Object\InvalidObjectException
   */
  public function isObject(): ValidateInterface;

  /**
   * Check if the method exists in the object.
   *
   * @param string $method
   *   the method name.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws \Components\Validate\Exceptions\Object\InvalidMethodCalledException
   */
  public function methodExists(string $method): ValidateInterface;

  /**
   * Check if a function is callable.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws \Components\Validate\Exceptions\Object\MethodNotCallableException
   */
  public function isCallable(): ValidateInterface;

  /**
   * Checks if the file exists.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws \Components\File\Exceptions\FileNotFoundException
   */
  public function fileExists(): ValidateInterface;

  /**
   * Checks if the file is a resource.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws \Components\File\Exceptions\FileNotOfResourceTypeException
   */
  public function isResource(): ValidateInterface;

  /**
   * Checks if the file is readable.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws \Components\File\Exceptions\FileNotReadableException
   */
  public function isReadable(): ValidateInterface;

  /**
   * Checks if the file is writable.
   *
   * @return ValidateInterface
   *   The called object reference.
   *
   * @throws \Components\File\Exceptions\FileNotWritableException
   */
  public function isWritable(): ValidateInterface;

}
