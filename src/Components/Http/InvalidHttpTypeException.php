<?php

declare(strict_types=1);


namespace Components\Http;

use Exception;
use JetBrains\PhpStorm\Pure;

/**
 * Provides an invalid HTTP type exception.
 *
 * @package Components\Http\Exceptions
 */
final class InvalidHttpTypeException extends Exception {

  /**
   * InvalidHttpTypeException constructor.
   *
   * @param string $http_type
   *   The HTTP type.
   */
  #[Pure] public function __construct(string $http_type) {
    parent::__construct("Invalid HTTP type `{$http_type}` given.");
  }

}
