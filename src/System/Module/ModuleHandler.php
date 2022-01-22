<?php
declare(strict_types=1);

namespace System\Module;

use Components\Config\Config;
use Components\Config\ConfigInterface;
use Components\Route\RouteBase;
use Components\Route\RouteCollection;
use Components\Route\RouteGet;
use Components\Route\RouteInterface;
use Components\Route\RoutePost;

/**
 * Provides a class for interacting with the modules.
 *
 * @package System\Module
 */
class ModuleHandler implements ModuleHandlerInterface {

  /**
   * The loaded modules.
   *
   * @var ModuleInterface[]
   */
  protected static array $modules = [];

  /**
   * ModuleHandler constructor.
   *
   * @param \Components\Config\ConfigInterface $config
   *   The config definition.
   */
  public function __construct(
    protected ConfigInterface $config = new Config('modules')
  ) {}

  /**
   * {@inheritDoc}
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
   * {@inheritDoc}
   */
  public function getRouteCollection(): RouteCollection {
    $route_collection = new RouteCollection();
    foreach ($this->getModules() as $module) {
      $route_locations = $module->getAttribute()->routes;
      foreach ($route_locations as $route_location) {
        $loaded_routes = $this->loadRoutesByParentClass($route_location);
        foreach ($loaded_routes as $key => $loaded_route) {
          $route_collection->add($key, $loaded_route);
        }
      }
    }

    return $route_collection;
  }

  /**
   * Loads the routes by attribute.
   *
   * @param string $parent_class
   *   The parent class.
   *
   * @return array<string, RouteBase>
   *   The loaded routes.
   */
  protected function loadRoutesByParentClass(string $parent_class): array {
    $attributes = [];
    $reflection_class = new \ReflectionClass($parent_class);

    foreach ($reflection_class->getMethods() as $method) {
      $method_attributes = $method->getAttributes(RouteGet::class);
      if (count($method_attributes) < 1) {
        $method_attributes = $method->getAttributes(RoutePost::class);
      }

      $method_attribute = reset($method_attributes);
      if (!$method_attribute instanceof \ReflectionAttribute) {
        continue;
      }

      $instance = $method_attribute->newInstance();
      if (!$instance instanceof RouteInterface) {
        continue;
      }

      $instance->setClass($reflection_class->name);
      $instance->setMethod($method->name);

      $attributes["{$reflection_class->name}.{$method->name}"] = $instance;
    }

    return $attributes;
  }

}
