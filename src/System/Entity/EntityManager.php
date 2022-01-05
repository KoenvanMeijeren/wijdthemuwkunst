<?php

declare(strict_types=1);

namespace System\Entity;

use System\Entity\Exceptions\EntityNotFoundException;

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
    if (!class_exists($entity)) {
      throw new EntityNotFoundException($entity);
    }

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
    if (!$this->entity->has($this->entity->getPrimaryKey())) {
      $this->entity->set($this->entity->getPrimaryKey(), EntityInterface::UNDEFINED_IDENTIFIER);
    }

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
