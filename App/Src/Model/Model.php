<?php

declare(strict_types=1);


namespace Src\Model;

use Src\Core\Router;
use Src\Core\URI;
use Src\Database\DB;
use stdClass;

/**
 * Provides a model to interact with the database.
 *
 * @package Src\Model
 */
abstract class Model {
  /**
   * The table to interact with.
   *
   * @var string
   */
  protected string $table;

  /**
   * The primary column key of the table.
   *
   * @var string
   */
  protected string $primaryKey;

  /**
   * The name of the slug column of the table.
   *
   * @var string
   */
  protected string $slugKey;

  /**
   * The soft deleted column key of the table.
   *
   * @var string
   */
  protected string $softDeletedKey;

  /**
   * The scopes of the model.
   *
   * @var mixed[]
   */
  protected array $scopes = [
    'query' => '',
    'values' => [],
  ];

  /**
   * Gets the current used id.
   *
   * @return int
   */
  public function getId(): int {
    return (int) Router::getWildcard();
  }

  /**
   * Gets the current used slug.
   *
   * @return string
   *   The slug.
   */
  public function getSlug(): string {
    return Router::getWildcard() === '' ? URI::getUrl() : Router::getWildcard();
  }

  /**
   * Gets the page by slug.
   *
   * @param string $slug
   *   The slug to search for.
   *
   * @return object|null
   *   The page object.
   */
  public function getBySlug(string $slug): ?stdClass {
    return $this->firstByAttributes([$this->slugKey => $slug]);
  }

  /**
   * Creates a new record.
   *
   * @param string[] $attributes
   */
  final public function create(array $attributes): void {
    DB::table($this->table)
      ->insert($attributes);
  }

  /**
   * Gets the first record matching the attributes or create it.
   *
   * @param string[] $attributes
   *
   * @return object
   */
  final public function firstOrCreate(array $attributes): stdClass {
    if (($result = $this->firstByAttributes($attributes)) !== NULL) {
      return $result;
    }

    $this->create($attributes);

    return $this->firstOrCreate($attributes);
  }

  /**
   * Create or update a record.
   *
   * @param int $id
   * @param string[] $attributes
   */
  final public function updateOrCreate(int $id, array $attributes): void {
    if ($this->firstById($id) === NULL) {
      $this->create($attributes);
      return;
    }

    $this->update($id, $attributes);
  }

  /**
   * Update a record.
   *
   * @param int $id
   * @param string[] $attributes
   */
  final public function update(int $id, array $attributes): void {
    DB::table($this->table)
      ->update($attributes)
      ->where($this->primaryKey, '=', (string) $id)
      ->execute();
  }

  /**
   * Get all records.
   *
   * @param string[] $columns
   *
   * @return object[]
   */
  final public function all(array $columns = ['*']): array {
    return (array) DB::table($this->table)
      ->select(implode(',', $columns))
      ->addStatementWithValues(
              $this->scopes['query'],
              $this->scopes['values']
          )
      ->get();
  }

  /**
   * Get the first record for the given id.
   *
   * @param int $id
   * @param string[] $columns
   *
   * @return object|null
   */
  final public function find(int $id, array $columns = ['*']): ?stdClass {
    return DB::table($this->table)
      ->select(implode(',', $columns))
      ->addStatementWithValues(
              $this->scopes['query'],
              $this->scopes['values']
          )
      ->where($this->primaryKey, '=', (string) $id)
      ->first();
  }

  /**
   * Delete a record by the given id..
   *
   * @param int $id
   *
   * @return mixed|void
   */
  final public function delete(int $id) {
    DB::table($this->table)
      ->delete($this->softDeletedKey)
      ->where($this->primaryKey, '=', (string) $id)
      ->execute();
  }

  /**
   * Get the first record for the given attributes.
   *
   * @param string[] $attributes
   *
   * @return object|null
   */
  protected function firstByAttributes(array $attributes): ?stdClass {
    return DB::table($this->table)
      ->select('*')
      ->addStatementWithValues(
              $this->scopes['query'],
              $this->scopes['values']
          )->addStatementWithValues(
              $this->convertAttributesIntoWhereQuery($attributes),
              $this->convertAttributesIntoWhereValues($attributes)
          )->first();
  }

  /**
   * Get the first record for the given id.
   *
   * @param int $id
   *
   * @return object|null
   */
  protected function firstById(int $id): ?stdClass {
    return DB::table($this->table)
      ->select('*')
      ->addStatementWithValues(
              $this->scopes['query'],
              $this->scopes['values']
          )
      ->where($this->primaryKey, '=', (string) $id)
      ->first();
  }

  /**
   * Adds a scope to the query.
   *
   * @param \Src\Database\DB $builder
   *   The query builder.
   */
  final protected function addScope(DB $builder): void {
    if (strpos($this->scopes['query'], $builder->getQuery()) !== FALSE
          || in_array($builder->getValues(), $this->scopes['values'], TRUE)
      ) {
      return;
    }

    $this->scopes['query'] .= $builder->getQuery();
    $this->scopes['values'] += $builder->getValues();
  }

  /**
   * Convert the given attributes into a query.
   *
   * @param string[] $attributes
   *
   * @return string
   */
  private function convertAttributesIntoWhereQuery(
        array $attributes
    ): string {
    $query = '';
    foreach ($attributes as $column => $attribute) {
      $query .= DB::table($this->table)
        ->where($column, '=', $attribute)
        ->getQuery();
    }
    return $query;
  }

  /**
   * Convert the given attributes into values.
   *
   * @param string[] $attributes
   *
   * @return string[]
   */
  private function convertAttributesIntoWhereValues(
        array $attributes
    ): array {
    $values = [];
    foreach ($attributes as $column => $attribute) {
      $values += DB::table($this->table)
        ->where($column, '=', $attribute)
        ->getValues();
    }

    return $values;
  }

}
