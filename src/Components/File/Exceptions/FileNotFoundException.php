<?php

declare(strict_types=1);


namespace Components\File\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;

/**
 * Provides an exception for non existing files.
 *
 * @package Components\File\Exceptions
 */
final class FileNotFoundException extends Exception {

  /**
   * FileNotFoundException constructor.
   *
   * @param string $file
   *   The file.
   */
  #[Pure] public function __construct(string $file) {
    parent::__construct("The given file `{$file}` does not exist on the filesystem.");
  }

}
