<?php declare(strict_types=1);

namespace Src\Model;

use Src\Database\DB;

/**
 * Provides a model for entities to interact with the database.
 *
 * @package Src\Model
 */
abstract class EntityModel implements EntityModelInterface {

  /**
   * The name of the table of the entity.
   *
   * @var string
   */
  protected string $table;

  /**
   * {@inheritDoc}
   */
  public function getTable(): string {
    return $this->table;
  }

  /**
   * {@inheritDoc}
   */
  public function getPrimaryKey(): string {
    return "{$this->getTable()}_ID";
  }

  /**
   * Creates a new record.
   *
   * @param string[] $attributes
   */
  protected function create(array $attributes): void {
    DB::table($this->table)->insert($attributes);
  }

  /**
   * Update a record.
   *
   * @param int $id
   * @param string[] $attributes
   */
  protected function update(int $id, array $attributes): void {
    DB::table($this->table)
      ->update($attributes)
      ->where($this->getPrimaryKey(), '=', (string) $id)
      ->execute();
  }

}
