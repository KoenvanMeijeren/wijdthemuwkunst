<?php

namespace Modules\Event\Entity;

use System\Entity\EntityInterface;
use System\Entity\EntityRepositoryInterface;

/**
 * Provides an interface for Page repositories.
 *
 * @package Modules\Event\Entity
 */
interface EventRepositoryInterface extends EntityRepositoryInterface {

  /**
   * {@inheritDoc}
   *
   * @param bool $archived
   *   Whether the events must be archived or not.
   */
  public function all(array $columns = ['*'], bool $archived = TRUE): array;

  /**
   * {@inheritDoc}
   *
   * @param bool $archived
   *   Whether the events must be archived or not.
   */
  public function firstByAttributes(array $attributes, array $columns = ['*'], bool $archived = TRUE): ?EntityInterface;

}
