<?php
declare(strict_types=1);

namespace Modules\Page\Entity;

use Exception;
use JetBrains\PhpStorm\Pure;

/**
 * Provides an invalid page visibility exception.
 *
 * @package \Modules\Page\Entity
 */
final class InvalidPageVisibilityException extends Exception {

  /**
   * InvalidPageVisibilityException constructor.
   *
   * @param int $visibility
   *   The page visibility.
   */
  #[Pure] public function __construct(int $visibility) {
    parent::__construct("Invalid page visibility `{$visibility}` given.");
  }

}
