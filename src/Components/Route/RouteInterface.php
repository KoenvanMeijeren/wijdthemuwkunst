<?php
declare(strict_types=1);


namespace Components\Route;

use Components\Attribute\AttributeInterface;

/**
 * Provides an interface for RouteInterface.
 *
 * @package Components\Route;
 */
interface RouteInterface extends AttributeInterface {

  /**
   * Instantiates the class.
   *
   * @return object
   *   The instantiated class.
   */
  public function instantiateClass(): object;

}
