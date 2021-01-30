<?php
declare(strict_types=1);

namespace Components\Validate\Exceptions\Object;

use Exception;

/**
 * Provides an exception for invalid methods calls on an object.
 *
 * @package Components\File\Exceptions
 */
final class InvalidMethodCalledException extends Exception {

  /**
   * InvalidMethodCalledException constructor.
   *
   * @param string $method
   *   The method name.
   * @param object $object
   *   The called object reference.
   */
  public function __construct(string $method, object $object) {
    $serialized_object = serialize($object);

    parent::__construct("The called method {$method} does not exist in the object {$serialized_object}");
  }

}
