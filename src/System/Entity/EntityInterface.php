<?php

namespace System\Entity;

use Components\Database\DatabaseConnectionInterface;
use System\Entity\Model\EntityModelInterface;
use System\Entity\Status\EntitySaveStatus;

/**
 * Provides an interface for entities.
 *
 * @package System\Entity
 */
interface EntityInterface extends EntityModelInterface {

  /**
   * The undefined identifier value.
   *
   * @var int
   */
  public const UNDEFINED_IDENTIFIER = DatabaseConnectionInterface::UNDEFINED_IDENTIFIER;

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
   * Determines if an attribute is set.
   *
   * @param string $key
   *   The key of the attribute.
   *
   * @return bool
   *   Whether the attribute is set or not.
   */
  public function has(string $key): bool;

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
   * @return \System\Entity\Status\EntitySaveStatus
   *   Either SAVED_NEW or SAVED_UPDATED, depending on the operation performed.
   */
  public function save(): EntitySaveStatus;

  /**
   * Acts on the post save of an entity.
   */
  public function postSave(): void;

  /**
   * Delete an entity.
   *
   * @return \System\Entity\Status\EntitySaveStatus
   *   The status of deleting an entity.
   */
  public function delete(): EntitySaveStatus;

}
