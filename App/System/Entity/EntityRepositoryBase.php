<?php


namespace System\Entity;

use Src\Database\DB;

/**
 * Defines a base for entity repositories.
 *
 * @package System\Entity
 */
abstract class EntityRepositoryBase implements EntityRepositoryInterface {

  /**
   * The entity definition.
   *
   * @var EntityInterface
   */
  protected EntityInterface $entity;

  /**
   * The scopes of the entity repository.
   *
   * @var mixed[]
   */
  protected array $scopes = [
    'query' => '',
    'values' => [],
  ];

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
   * @return object|null
   *   The entity.
   */
  protected function firstByAttributes(array $attributes, array $columns = ['*']): ?EntityInterface {
    return DB::table($this->entity->getTable())
      ->select(implode(',', $columns))
      ->addStatementWithValues($this->scopes['query'], $this->scopes['values'])
      ->whereAttributes($attributes)
      ->firstToClass(get_class($this->entity));
  }

  /**
   * {@inheritDoc}
   */
  public function loadById(int $id, array $columns = ['*']): ?EntityInterface {
    return DB::table($this->entity->getTable())
      ->select(implode(',', $columns))
      ->addStatementWithValues($this->scopes['query'], $this->scopes['values'])
      ->where($this->entity->getPrimaryKey(), '=', (string) $id)
      ->firstToClass(get_class($this->entity));
  }

  /**
   * {@inheritDoc}
   */
  public function all(array $columns = ['*']): array {
    return DB::table($this->entity->getTable())
      ->select(implode(',', $columns))
      ->addStatementWithValues($this->scopes['query'], $this->scopes['values'])
      ->fetchAllToClass(get_class($this->entity));
  }

  /**
   * Adds a scope to the query.
   *
   * @param \Src\Database\DB $builder
   *   The query builder.
   */
  protected function addScope(DB $builder): void {
    if (strpos($this->scopes['query'], $builder->getQuery()) !== FALSE
      || in_array($builder->getValues(), $this->scopes['values'], TRUE)
    ) {
      return;
    }

    $this->scopes['query'] .= $builder->getQuery();
    $this->scopes['values'] += $builder->getValues();
  }

}
