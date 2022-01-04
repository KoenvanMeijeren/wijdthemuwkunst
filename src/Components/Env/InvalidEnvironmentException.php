<?php
declare(strict_types=1);

namespace Components\Env;

use Exception;
use JetBrains\PhpStorm\Pure;

/**
 * Provides an invalid environment exception.
 *
 * @package \System\Entity\Status
 */
final class InvalidEnvironmentException extends Exception {

  /**
   * InvalidEnvironmentException constructor.
   *
   * @param string $environment
   *   The environment.
   */
  #[Pure] public function __construct(string $environment) {
    parent::__construct("Invalid environment `{$environment}` given.");
  }

}
