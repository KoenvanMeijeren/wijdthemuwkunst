<?php
declare(strict_types=1);

namespace System\Module;

use Components\Config\Config;
use Components\Config\ConfigInterface;
use JetBrains\PhpStorm\Pure;

/**
 * Provides a class for interacting with the modules.
 *
 * @package System\Module
 */
class ModuleHandler implements ModuleHandlerInterface {

  /**
   * The config definition.
   *
   * @var ConfigInterface
   */
  protected ConfigInterface $config;

  /**
   * ModuleHandler constructor.
   */
  public function __construct() {
    $this->config = new Config('modules');
  }

  /**
   * Gets the modules.
   *
   * @return ModuleInterface[]
   *   The loaded modules.
   */
  public function getModules(): array {
    $modules = [];
    foreach ($this->config->all() as $module) {
      $modules[] = $this->getModule($module);
    }

    return $modules;
  }

  /**
   * Gets a specific module.
   *
   * @param string $name
   *   The name of the module.
   *
   * @return ModuleInterface
   *   The loaded module.
   */
  public function getModule(string $name): ModuleInterface {
    return new $name;
  }

}
