<?php

namespace System\Entity;

/**
 * Defines an interface for entity managers.
 *
 * @package System\Entity
 */
interface EntityManagerInterface {

  /**
   * Gets the entity storage.
   *
   * @param string $entity
   *   The entity.
   *
   * @return $this
   *
   * @throws \System\Entity\Exceptions\EntityNotFoundException
   *   If the entity does not exists.
   */
  public function getStorage(string $entity): EntityManagerInterface;

  /**
   * Returns the repository for the entity.
   *
   * @return EntityRepositoryInterface
   *   The repository.
   */
  public function getRepository(): EntityRepositoryInterface;

  /**
   * Creates the entity.
   *
   * @param array $values
   *   The values of the entity.
   *
   * @return EntityInterface
   *   The entity.
   */
  public function create(array $values = []): EntityInterface;

  /**
   * Loads an entity.
   *
   * @param int $id
   *   The id of the entity.
   *
   * @return EntityInterface|null
   *   The loaded entity.
   */
  public function load(int $id): ?EntityInterface;

  /**
   * Loads records for the given attributes.
   *
   * @param array $attributes
   *   The attributes.
   *
   * @return EntityInterface|null
   *   The loaded entity.
   */
  public function loadByAttributes(array $attributes): ?EntityInterface;

}
