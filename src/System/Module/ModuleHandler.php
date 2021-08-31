<?php
declare(strict_types=1);

namespace System\Module;

use Components\Config\Config;
use Components\Config\ConfigInterface;
use Components\File\Exceptions\FileNotFoundException;

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
   * The loaded modules.
   *
   * @var ModuleInterface[]
   */
  protected static array $modules = [];

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
  public function getModules(callable $callable = null): array {
    if (count(self::$modules) > 0) {
      if ($callable) {
        return array_map($callable, self::$modules);
      }

      return self::$modules;
    }

    self::$modules = array_map(static function (string $module) {
      return new $module;
    }, $this->config->all());

    return $this->getModules($callable);
  }

  /**
   * Gets the modules.
   *
   * @return ModuleInterface[]
   *   The loaded modules.
   */
  public function getRoutes(): array {
    $routes = $this->getModules(static function(ModuleInterface $module) {
      return $module->getRoutesLocation();
    });

    return array_filter($routes, static function(?string $route) {
      return $route !== null;
    });
  }

}