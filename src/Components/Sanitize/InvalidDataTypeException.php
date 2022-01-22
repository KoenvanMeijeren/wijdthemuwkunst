<?php
declare(strict_types=1);

namespace Components\Sanitize;

use Exception;
use JetBrains\PhpStorm\Pure;

/**
 * Provides an invalid data type exception.
 *
 * @package \Components\Sanitize
 */
final class InvalidDataTypeException extends Exception {

  /**
   * InvalidDataTypeException constructor.
   *
   * @param string $data_type
   *   The data type.
   */
  #[Pure] public function __construct(string $data_type) {
    parent::__construct("Invalid data type `{$data_type}` given.");
  }

}
