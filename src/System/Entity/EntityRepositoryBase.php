<?php

declare(strict_types=1);

namespace System\Entity;

use Components\Database\Query;
use Components\Database\QueryInterface;
use Components\Database\Scopes\SoftDelete\SoftDelete;

/**
 * Defines a base for entity repositories.
 *
 * @package System\Entity
 */
abstract class EntityRepositoryBase implements EntityRepositoryInterface {

  use SoftDelete;

  /**
   * The entity definition.
   *
   * @var EntityInterface
   */
  protected EntityInterface $entity;

  /**
   * The query definition.
   *
   * @var QueryInterface
   */
  protected QueryInterface $query;

  /**
   * {@inheritDoc}
   */
  public function setEntity(EntityInterface $entity): void {
    $this->entity = $entity;
  }

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
  protected function firstByAttributes(array $attributes, array $columns = ['*']): ?EntityInterface {
    $this->query = new Query($this->entity->getTable());
    $this->query->select($this->query->columnsToString($columns));
    $this->query->whereAttributes($attributes);

    $this->addGlobalFilters();
    $entity = $this->query->firstToClass($this->entity::class);

    if ($entity instanceof EntityInterface) {
      return $entity;
    }

    return null;
  }

  /**
   * {@inheritDoc}
   */
  public function loadById(int $id, array $columns = ['*']): ?EntityInterface {
    $this->query = new Query($this->entity->getTable());
    $this->query->select($this->query->columnsToString($columns));
    $this->query->where($this->entity->getPrimaryKey(), '=', (string) $id);

    $this->addGlobalFilters();
    $entity = $this->query->firstToClass($this->entity::class);

    if ($entity instanceof EntityInterface) {
      return $entity;
    }

    return null;
  }

  /**
   * {@inheritDoc}
   */
  public function all(array $columns = ['*']): array {
    $this->query = new Query($this->entity->getTable());
    $this->query->select($this->query->columnsToString($columns));

    $this->addGlobalFilters();

    return $this->query->allToClass($this->entity::class);
  }

  /**
   * Adds global filters for the queries.
   */
  protected function addGlobalFilters(): void {
    $this->initializeSoftDelete($this->entity->getSoftDeletedKey());
  }

}
