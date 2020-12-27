<?php
declare(strict_types=1);

namespace Src\Exceptions\Basic;

use Exception;

/**
 * Throws an undefined route exception.
 *
 * @package Src\Exceptions\Basic
 */
final class UndefinedRouteException extends Exception {

  /**
   * {@inheritdoc}
   */
  protected $message = 'No route defined for this request';

}
