<?php

namespace System\Entity;

use System\Entity\Model\EntityModel;

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
  protected string $repository;

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
  public function id(): ?int {
    return $this->get($this->getPrimaryKey());
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
   * {@inheritDoc}
   */
  public function setValues(array $values) {
    $this->attributes = array_merge($this->attributes, $values);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function save(): int {
    if ($this->id() === NULL) {
      $this->create($this->attributes);
      return self::SAVED_NEW;
    }

    $this->update($this->id(), $this->attributes);
    return self::SAVED_UPDATED;
  }

  /**
   * {@inheritDoc}
   */
  public function delete(): int {
    $this->softDelete($this->id());

    return self::SAVED_DELETED;
  }

}
