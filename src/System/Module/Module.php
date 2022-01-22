<?php
declare(strict_types=1);

namespace System\Module;

use Components\Attribute\AttributeInterface;

/**
 * Provides a class for Module.
 *
 * @package System\Module;
 */
#[\Attribute]
final class Module implements AttributeInterface {

  /**
   * Constructs a module.
   *
   * @param string $name
   *   The name of the module.
   * @param string[] $routes
   *   The classes which have routes defined.
   */
  public function __construct(
    public readonly string $name,
    public readonly array $routes = []
  ) {}

}
