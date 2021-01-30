<?php
declare(strict_types=1);

namespace Components\File\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

/**
 * Provides an exception for errors while uploading a file.
 *
 * @package Components\File\Exceptions
 */
final class ErrorWhileUploadingFileException extends Exception {

  /**
   * ErrorWhileUploadingFileException constructor.
   *
   * @param Throwable|null $previous
   *   The previous exception.
   */
  #[Pure] public function __construct(Throwable $previous = null) {
    parent::__construct('There was an error while uploading the file.', 114, $previous);
  }

}
