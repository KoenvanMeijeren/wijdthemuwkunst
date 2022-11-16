<?php

namespace System\Entity;

/**
 * Defines an interface for entity repositories.
 *
 * @package System\Entity
 */
interface EntityRepositoryInterface {

  /**
   * Sets the entity for the repository.
   *
   * @param EntityInterface $entity
   *   The entity.
   */
  public function setEntity(EntityInterface $entity): void;

  /**
   * Get the first record for the given attributes.
   *
   * @param string[] $attributes
   *   The attributes to search the data for.
   * @param array $columns
   *   The columns to be selected.
   *
   * @return EntityInterface|null
   *   The entity.
   */
  public function firstByAttributes(array $attributes, array $columns = ['*']): ?EntityInterface;

  /**
   * Loads the first found record for the given id.
   *
   * @param int $id
   *   The id to search for.
   * @param array $columns
   *   The columns to be selected.
   *
   * @return EntityInterface|null
   *   The loaded entity.
   */
  public function loadById(int $id, array $columns = ['*']): ?EntityInterface;

  /**
   * Get all records.
   *
   * @param string[] $columns
   *   The columns to be selected.
   *
   * @return EntityInterface[]
   *   The entities.
   */
  public function all(array $columns = ['*']): array;

}
