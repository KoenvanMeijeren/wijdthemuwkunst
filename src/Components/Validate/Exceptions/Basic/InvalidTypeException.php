<?php
declare(strict_types=1);

namespace Components\Validate\Exceptions\Basic;

use Exception;

/**
 * Provides an exception for invalid variable types.
 *
 * @package Components\File\Exceptions
 */
final class InvalidTypeException extends Exception {

  /**
   * InvalidTypeException constructor.
   *
   * @param mixed $variable
   *   The given variable.
   * @param string $desired_type
   *   The desired variable type.
   */
  public function __construct(mixed $variable, string $desired_type) {
    $variable_type = gettype($variable);

    parent::__construct("Variable of the type `{$variable_type}` given. The variable must be of the type `{$desired_type}`.");
  }

}
