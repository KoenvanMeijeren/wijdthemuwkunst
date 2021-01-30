<?php
declare(strict_types=1);

namespace Components\Validate\Exceptions\Object;

use Exception;

/**
 * Provides an exception for invalid objects.
 *
 * @package Components\File\Exceptions
 */
final class MethodNotCallableException extends Exception {

  /**
   * MethodNotCallableException constructor.
   *
   * @param mixed $object
   *   The called object reference.
   */
  public function __construct(object $object) {
    $serialized_object = serialize($object);

    parent::__construct("The called method does not exist in the given object {$serialized_object}");
  }

}
