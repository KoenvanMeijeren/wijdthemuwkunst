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
   */
  public function getStorage(string $entity);

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
