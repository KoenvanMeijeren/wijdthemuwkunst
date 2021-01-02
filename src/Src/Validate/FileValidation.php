<?php

declare(strict_types=1);


namespace Src\Validate;

use Src\Exceptions\File\FileNotFoundException;
use Src\Exceptions\File\FileNotOfResourceTypeException;
use Src\Exceptions\File\FileNotReadableException;
use Src\Exceptions\File\FileNotWritableException;

/**
 * Provides a trait for uri validation actions.
 *
 * @package src\Validate
 */
trait FileValidation {

  /**
   * Check if the file exists.
   *
   * @return Validate
   *
   * @throws \Src\Exceptions\File\FileNotFoundException
   */
  public function fileExists(): Validate {
    if (file_exists(self::$var)) {
      return new Validate();
    }

    throw new FileNotFoundException(
          'Could not load the given file ' . self::$var
      );
  }

  /**
   * Check if the file is a resource.
   *
   * @return Validate
   *
   * @throws \Src\Exceptions\File\FileNotOfResourceTypeException
   */
  public function isResource(): Validate {
    if (!is_resource(self::$var)) {
      throw new FileNotOfResourceTypeException(
            'The file must be a resource: ' . self::$var
        );
    }

    return new Validate();
  }

  /**
   * Check if the file is readable.
   *
   * @return Validate
   *
   * @throws \Src\Exceptions\File\FileNotReadableException
   */
  public function isReadable(): Validate {
    if (!is_readable(self::$var)) {
      throw new FileNotReadableException(
            'The file must be readable: ' . self::$var
        );
    }

    return new Validate();
  }

  /**
   * Check if the file is writable.
   *
   * @return Validate
   *
   * @throws \Src\Exceptions\File\FileNotWritableException
   */
  public function isWritable(): Validate {
    if (!is_writable(self::$var)) {
      throw new FileNotWritableException(
            'The file must be writable: ' . self::$var
        );
    }

    return new Validate();
  }

}
