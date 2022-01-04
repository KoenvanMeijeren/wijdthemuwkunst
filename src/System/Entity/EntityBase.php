<?php

namespace System\Entity;

use System\Entity\Model\EntityModel;
use System\Entity\Status\EntitySaveStatus;

/**
 * Provides a base class for entities.
 *
 * @package System\Entity
 */
abstract class EntityBase extends EntityModel implements EntityInterface {

  /**
   * The name of the repository of the entity.
   *
   * @var string
   */
  protected string $repository = EntityRepository::class;

  /**
   * The attributes of the entity.
   *
   * @var array
   */
  protected array $attributes = [];

  /**
   * {@inheritDoc}
   */
  public function getRepository(): EntityRepositoryInterface {
    /** @var EntityRepositoryInterface $repository */
    $repository = new $this->repository;
    $repository->setEntity($this);
    return $repository;
  }

  /**
   * {@inheritDoc}
   */
  public function id(): int {
    return (int) $this->get($this->getPrimaryKey());
  }

  /**
   * {@inheritDoc}
   */
  public function set(string $key, $value) {
    $attribute = "{$this->table}_{$key}";
    if (str_contains($key, $this->table)) {
      $attribute = $key;
    }

    $this->attributes[$attribute] = $value;
    return $this;
  }

  /**
   * Stores an attribute of the entity.
   *
   * @param $name
   *   The name of the attribute.
   * @param $value
   *   The value of the attribute.
   */
  public function __set($name, $value) {
    $this->set($name, $value);
  }

  /**
   * {@inheritDoc}
   */
  public function get(string $key) {
    $attribute = "{$this->table}_{$key}";
    if (str_contains($key, $this->table)) {
      $attribute = $key;
    }

    return $this->attributes[$attribute] ?? NULL;
  }

  /**
   * Stores an attribute of the entity.
   *
   * @param $name
   *   The name of the attribute.
   */
  public function __get($name) {
    $this->get($name);
  }

  /**
   * {@inheritDoc}
   */
  public function setValues(array $values) {
    $this->attributes = array_merge($this->attributes, $values);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function preSave(): void {
    $this->alterSavableAttributes();
  }

  /**
   * {@inheritDoc}
   */
  public function save(): EntitySaveStatus {
    // Stores the current state of the attributes for saving.
    $attributes = $this->attributes;

    $this->preSave();

    $entity_id = $this->id();
    if ($entity_id === 0) {
      $this->create($this->attributes);
      $result = EntitySaveStatus::SAVED_NEW;
    } else {
      // Primary keys cannot be updated because they are auto incremented.
      if (isset($this->attributes[$this->getPrimaryKey()])) {
        unset($this->attributes[$this->getPrimaryKey()]);
      }

      $this->update($entity_id, $this->attributes);
      $result = EntitySaveStatus::SAVED_UPDATED;
    }

    $this->postSave();

    // Restores the attributes after saving it.
    $this->attributes = $attributes;

    return $result;
  }

  /**
   * Alters the attributes in order to prepare the save of the entity.
   */
  protected function alterSavableAttributes(): void {

  }

  /**
   * {@inheritDoc}
   */
  public function postSave(): void {

  }

  /**
   * {@inheritDoc}
   */
  public function delete(): EntitySaveStatus {
    $this->softDelete($this->id());

    return EntitySaveStatus::SAVED_DELETED;
  }

}
