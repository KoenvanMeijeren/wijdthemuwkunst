<?php

declare(strict_types=1);

namespace System\Entity;

/**
 * Defines a manager for entities.
 *
 * @package System\Entity
 */
final class EntityManager extends EntityRepositoryBase implements EntityManagerInterface {

  /**
   * {@inheritDoc}
   */
  public function getStorage(string $entity): EntityManagerInterface {
    $this->entity = new $entity();
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getRepository(): EntityRepositoryInterface {
    return $this->entity->getRepository();
  }

  /**
   * {@inheritDoc}
   */
  public function create(array $values = []): EntityInterface {
    $this->entity->setValues($values);
    return $this->entity;
  }

  /**
   * {@inheritDoc}
   */
  public function load(int $id): ?EntityInterface {
    return $this->loadById($id);
  }

  /**
   * {@inheritDoc}
   */
  public function loadByAttributes(array $attributes): ?EntityInterface {
    return $this->getRepository()->firstByAttributes($attributes);
  }

}
