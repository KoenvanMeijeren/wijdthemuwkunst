<?php
declare(strict_types=1);

namespace System\Entity\Status;

use Exception;
use JetBrains\PhpStorm\Pure;

/**
 * Provides an invalid entity status exception.
 *
 * @package \System\Entity\Status
 */
final class InvalidEntityStatusException extends Exception {

  /**
   * InvalidEntityStatusException constructor.
   *
   * @param int $status
   *   The entity status.
   */
  #[Pure] public function __construct(int $status) {
    parent::__construct("Invalid entity status `{$status}` given.");
  }

}
