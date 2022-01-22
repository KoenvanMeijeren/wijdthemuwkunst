<?php
declare(strict_types=1);

namespace System\Module;

use Components\Route\RouteCollection;

/**
 * Provides an interface for interacting with the modules.
 *
 * @package System\Module
 */
interface ModuleHandlerInterface {

  /**
   * Gets the modules.
   *
   * @return ModuleInterface[]
   *   The loaded modules.
   */
  public function getModules(callable $callable = null): array;

  /**
   * Gets the modules.
   *
   * @return \Components\Route\RouteCollection
   *   The route collection.
   */
  public function getRouteCollection(): RouteCollection;

}
