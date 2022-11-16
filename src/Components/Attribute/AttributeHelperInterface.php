<?php
declare(strict_types=1);

namespace Components\Attribute;

/**
 * Provides an interface for helper methods for attributes.
 *
 * @package \Components\Attribute
 */
interface AttributeHelperInterface {

  /**
   * Gets the specified attribute from the parent class.
   *
   * @param string $attribute
   *   The attribute to search for.
   *
   * @return \Components\Attribute\AttributeInterface|null
   *   The attribute.
   */
  public function getByClass(string $attribute): ?AttributeInterface;

  /**
   * Gets the specified attributes from the parent class methods.
   *
   * @param string $attribute
   *   The attribute to search for.
   *
   * @return \Components\Attribute\AttributeInterface[]|null
   *   The attributes, only one attribute per method is loaded.
   */
  public function getByMethods(string $attribute): ?array;

}
