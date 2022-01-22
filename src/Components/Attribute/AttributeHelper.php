<?php
declare(strict_types=1);

namespace Components\Attribute;

use JetBrains\PhpStorm\Pure;

/**
 * Provides a class for helper methods for attributes.
 *
 * @package \Components\Attribute
 */
final class AttributeHelper implements AttributeHelperInterface {

  /**
   * The reflection class.
   *
   * @var \ReflectionClass<object>
   */
  public readonly \ReflectionClass $reflectionClass;

  /**
   * Constructs the attribute helper.
   *
   * @param object $parentClass
   *   The parent class.
   */
  public function __construct(
    public readonly object|string $parentClass
  ) {
    $this->reflectionClass = new \ReflectionClass($this->parentClass);
  }

  /**
   * {@inheritdoc}
   */
  public function getByClass(string $attribute): ?AttributeInterface {
    $attributes = $this->reflectionClass->getAttributes($attribute);
    if (empty($attributes)) {
      return NULL;
    }

    /** @var \ReflectionAttribute $reflection_attribute */
    $reflection_attribute = reset($attributes);

    $instance = $reflection_attribute->newInstance();
    if (!$instance instanceof AttributeInterface) {
      return NULL;
    }

    return $instance;
  }

  /**
   * {@inheritdoc}
   */
  public function getByMethods(string $attribute): ?array {
    $attributes = [];
    foreach ($this->reflectionClass->getMethods() as $method) {
      $method_attributes = $method->getAttributes($attribute);
      $method_attribute = reset($method_attributes);
      if (!$method_attribute instanceof \ReflectionAttribute) {
        continue;
      }

      $attributes["{$this->reflectionClass->name}.{$method->name}"] = $method_attribute->newInstance();
    }

    return $attributes;
  }

}
