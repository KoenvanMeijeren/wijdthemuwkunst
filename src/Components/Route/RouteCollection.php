<?php
declare(strict_types=1);

namespace Components\Route;

use Components\Collection\CollectionBase;
use Components\Http\HttpTypes;

/**
 * Provides a class for RouteCollection.
 *
 * @package Components\Route;
 */
final class RouteCollection extends CollectionBase {

  /**
   * The route collection.
   *
   * @var array
   */
  protected array $items;

  /**
   * The routes named by route name.
   *
   * @var \Components\Route\RouteInterface[]
   */
  protected array $namedRoutes = [];

  /**
   * The available routes.
   *
   * @var array<string, \Components\Route\RouteGet|\Components\Route\RoutePost>
   */
  protected array $availableRoutes = [];

  /**
   * Sets the available routes based on the current rights of the user.
   *
   * @param \Components\Http\HttpTypes $httpType
   *   The HTTP type.
   * @param \Components\Route\RouteRights $rights
   *   The rights of the user.
   */
  protected function setAvailableRoutes(HttpTypes $httpType, RouteRights $rights): void {
    $this->availableRoutes = [];
    for ($maximumRights = RouteRights::GUEST->value; $maximumRights <= $rights->value; ++$maximumRights) {
      if (isset($this->items[$httpType->value][$maximumRights])) {
        foreach ($this->items[$httpType->value][$maximumRights] as $url => $route) {
          $this->availableRoutes[$url] = $route;
        }
      }
    }
  }

  /**
   * Gets the available routes based on the current rights of the user.
   *
   * @param \Components\Http\HttpTypes $httpType
   *   The HTTP type.
   * @param \Components\Route\RouteRights $rights
   *   The rights of the user.
   *
   * @return array<string, \Components\Route\RouteGet|\Components\Route\RoutePost>
   *   The available routes.
   */
  public function getAvailableRoutes(HttpTypes $httpType, RouteRights $rights): array {
    if (count($this->availableRoutes) > 0) {
      return $this->availableRoutes;
    }

    $this->setAvailableRoutes($httpType, $rights);
    return $this->availableRoutes;
  }

  /**
   * Adds data to the array.
   *
   * @param string $key
   *   The key of the array item.
   * @param \Components\Route\RouteInterface $value
   *   The value of the key.
   */
  public function add(string $key, mixed $value): void {
    if (!$value instanceof RouteInterface) {
      $class_name = get_class($value);
      throw new \InvalidArgumentException("Value must be instance of Route attribute, but {$class_name} was given.");
    }

    $this->items[$value->httpType->value][$value->rights->value][$value->url] = $value;

    if ($value->route && !isset($this->namedRoutes[$value->route])) {
      $this->namedRoutes[$value->route] = $value;
      return;
    }

    $class_paths = explode(separator: '\\', string: $value->class);
    $class_name = strtolower(end($class_paths));

    $this->namedRoutes["{$class_name}.{$value->method}"] = "/{$value->url}";
  }

}
