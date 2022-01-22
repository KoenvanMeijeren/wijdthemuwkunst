<?php
declare(strict_types=1);

namespace Components\Validate\Exceptions\Object;

use Exception;

/**
 * Provides an exception for invalid objects.
 *
 * @package Components\File\Exceptions
 */
final class InvalidObjectException extends Exception {

  /**
   * InvalidMethodCalledException constructor.
   *
   * @param mixed $variable
   *   The given variable.
   */
  public function __construct(mixed $variable) {
    $type = gettype($variable);

    parent::__construct("Variable of the type `{$type}` given. The variable must be an object.");
  }

}
