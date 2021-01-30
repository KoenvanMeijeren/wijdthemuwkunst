<?php

declare(strict_types=1);


namespace Components\SuperGlobals\Url\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;

/**
 * Provides an invalid env exception.
 *
 * @package Components\SuperGlobals\Url\Exceptions
 */
final class InvalidEnvException extends Exception {

  /**
   * InvalidDomainException constructor.
   *
   * @param string $env
   *   The env.
   */
  #[Pure] public function __construct(string $env) {
    parent::__construct("Invalid environment `{$env}` given.");
  }

}
