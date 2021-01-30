<?php

declare(strict_types=1);


namespace Components\SuperGlobals\Url\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;

/**
 * Provides an invalid uri exception.
 *
 * @package Components\SuperGlobals\Url\Exceptions
 */
final class InvalidUriException extends Exception {

  /**
   * InvalidDomainException constructor.
   *
   * @param string $uri
   *   The uri.
   */
  #[Pure] public function __construct(string $uri) {
    parent::__construct("Invalid uri `{$uri}` given.");
  }

}
