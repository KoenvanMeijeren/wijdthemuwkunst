<?php

namespace System\Entity;

use System\Entity\Model\EntityModelInterface;

/**
 * Provides an interface for entities.
 *
 * @package System\Entity
 */
interface EntityInterface extends EntityModelInterface {

  /**
   * Return status for saving which involved creating a new item.
   *
   * @var int
   */
  public const SAVED_NEW = 1;

  /**
   * Return status for saving which involved an update to an existing item.
   *
   * @var int
   */
  public const SAVED_UPDATED = 2;

  /**
   * Return status for saving which deleted an existing item.
   *
   * @var int
   */
  public const SAVED_DELETED = 3;

  /**
   * Returns the repository for the entity.
   *
   * @return EntityRepositoryInterface
   *   The repository.
   */
  public function getRepository(): EntityRepositoryInterface;

  /**
   * Returns the id of the entity.
   *
   * @return int
   *   The id of the entity.
   */
  public function id(): int;

  /**
   * Sets an attribute on the entity.
   *
   * @param string $key
   *   The key of the attribute.
   * @param $value
   *   The value of the attribute.
   *
   * @return $this
   */
  public function set(string $key, $value);

  /**
   * Gets an attribute of the entity.
   *
   * @param string $key
   *   The key of the attribute.
   *
   * @return mixed|null
   *   The value of the attribute.
   */
  public function get(string $key);

  /**
   * Sets the default values of the entity.
   *
   * @param array $values
   *   The values.
   *
   * @return $this
   */
  public function setValues(array $values);

  /**
   * Acts on the pre save of an entity.
   */
  public function preSave(): void;

  /**
   * Saves an entity.
   *
   * @return int
   *   Either SAVED_NEW or SAVED_UPDATED, depending on the operation performed.
   */
  public function save(): int;

  /**
   * Acts on the post save of an entity.
   */
  public function postSave(): void;

  /**
   * Delete an entity.
   *
   * @return int
   *   The status of deleting an entity.
   */
  public function delete(): int;

}
