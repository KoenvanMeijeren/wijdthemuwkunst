<?php

declare(strict_types=1);


namespace Src\Model;

use Components\ComponentsTrait;
use Components\Database\Query;
use Components\Database\QueryInterface;
use Components\Route\Router;
use Components\SuperGlobals\Url\Uri;
use stdClass;

/**
 * Provides a model to interact with the database.
 *
 * @package Src\Model
 * @deprecated
 */
abstract class Model {

  use ComponentsTrait;

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
    return (int) $this->request()->getRouteParameter();
  }

  /**
   * Gets the current used slug.
   *
   * @return string
   *   The slug.
   */
  public function getSlug(): string {
    return Router::getWildcard() === '' ? Uri::getUrl() : Router::getWildcard();
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
    $query = new Query($this->table);
    $query->insert($attributes);
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
    $query = new Query($this->table);
    $query->update($attributes)->where($this->primaryKey, '=', (string) $id);
    $query->execute();
  }

  /**
   * Get all records.
   *
   * @param string[] $columns
   *
   * @return object[]
   */
  final public function all(array $columns = ['*']): array {
    $query = new Query($this->table);

    return $query->select(implode(',', $columns))
      ->addStatementWithValues($this->scopes['query'], $this->scopes['values'])
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
    $query = new Query($this->table);

    return $query->select(implode(',', $columns))
      ->addStatementWithValues($this->scopes['query'], $this->scopes['values'])
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
    $query = new Query($this->table);

    $query->delete($this->softDeletedKey)
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
    $query = new Query($this->table);

    return $query->select('*')
      ->addStatementWithValues($this->scopes['query'], $this->scopes['values'])
      ->addStatementWithValues(
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
    $query = new Query($this->table);

    return $query->select('*')
      ->addStatementWithValues($this->scopes['query'], $this->scopes['values'])
      ->where($this->primaryKey, '=', (string) $id)
      ->first();
  }

  /**
   * Adds a scope to the query.
   *
   * @param \Components\Database\QueryInterface $builder
   *   The query builder.
   */
  protected function addScope(QueryInterface $builder): void {
    if (str_contains($this->scopes['query'], $builder->getQuery())
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
  private function convertAttributesIntoWhereQuery(array $attributes): string {
    $queryString = '';
    foreach ($attributes as $column => $attribute) {
      $query = new Query($this->table);
      $queryString .= $query->where($column, '=', $attribute)->getQuery();
    }
    return $queryString;
  }

  /**
   * Convert the given attributes into values.
   *
   * @param string[] $attributes
   *
   * @return string[]
   */
  private function convertAttributesIntoWhereValues(array $attributes): array {
    $values = [];
    foreach ($attributes as $column => $attribute) {
      $query = new Query($this->table);
      $values += $query->where($column, '=', $attribute)->getValues();
    }

    return $values;
  }

}
