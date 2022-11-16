<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Url\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;

/**
 * Provides an invalid domain exception.
 *
 * @package Components\SuperGlobals\Url\Exceptions
 */
final class InvalidDomainException extends Exception {

  /**
   * InvalidDomainException constructor.
   *
   * @param string $domain
   *   The domain.
   */
  #[Pure] public function __construct(string $domain) {
    parent::__construct("Invalid domain `{$domain}` given.");
  }

}
