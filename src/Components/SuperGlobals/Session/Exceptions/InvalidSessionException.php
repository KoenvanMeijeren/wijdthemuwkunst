<?php
declare(strict_types=1);

namespace Components\SuperGlobals\Session\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;

/**
 * Provides an exception for invalid sessions.
 *
 * @package Components\SuperGlobals\Session\Exceptions
 */
final class InvalidSessionException extends Exception {

  /**
   * InvalidSessionException constructor.
   */
  #[Pure] public function __construct() {
    parent::__construct('The current session is invalid.');
  }

}
