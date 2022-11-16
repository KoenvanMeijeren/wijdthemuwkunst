<?php
declare(strict_types=1);

namespace Components\Route;

use Exception;
use JetBrains\PhpStorm\Pure;

/**
 * Provides an invalid route rights exception.
 *
 * @package Components\Http\Exceptions
 */
final class InvalidRouteRightsException extends Exception {

  /**
   * InvalidRouteRightsException constructor.
   *
   * @param int $route_rights
   *   The route rights.
   */
  #[Pure] public function __construct(int $route_rights) {
    parent::__construct("Invalid route rights `{$route_rights}` given.");
  }

}
