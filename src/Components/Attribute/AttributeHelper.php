<?php
declare(strict_types=1);

namespace Components\Attribute;

/**
 * Provides a class for helper methods for attributes.
 *
 * @package \Components\Attribute
 */
class AttributeHelper implements AttributeHelperInterface {

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
    public readonly object $parentClass
  ) {
    $this->reflectionClass = new \ReflectionClass($this->parentClass);
  }

  /**
   * {@inheritdoc}
   */
  public function getAttribute(string $attribute): ?AttributeInterface {
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

}
