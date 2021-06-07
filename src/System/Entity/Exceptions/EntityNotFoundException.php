<?php
declare(strict_types=1);

namespace System\Entity\Exceptions;

use JetBrains\PhpStorm\Pure;

/**
 * Provides an exception for non-existing entities.
 *
 * @package System\Entity\Exceptions
 */
class EntityNotFoundException extends \Exception {

  /**
   * EntityNotFoundException constructor.
   *
   * @param string $entity
   *   The entity.
   */
  #[Pure] public function __construct(string $entity) {
    parent::__construct("The given entity `{$entity}` does not have a dedicated class.");
  }

}
