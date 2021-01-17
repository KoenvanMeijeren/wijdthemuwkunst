<?php

declare(strict_types=1);

namespace System\Entity\Model;

use Src\Database\DB;

/**
 * Provides a model for entities to interact with the database.
 *
 * @package src\Model
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
   * {@inheritDoc}
   */
  public function getSoftDeletedKey(): string {
    return "{$this->getTable()}_is_deleted";
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
   * Updates a record.
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

  /**
   * Deletes a record without deleting it.
   *
   * @param int $id
   *   The id of the record to be deleted.
   */
  protected function softDelete(int $id): void {
    DB::table($this->table)
      ->delete($this->getSoftDeletedKey())
      ->where($this->getPrimaryKey(), '=', (string) $id)
      ->execute();
  }

  /**
   * Permanently deletes a record.
   *
   * @param int $id
   *   The id of the record to be deleted.
   */
  protected function permanentDelete(int $id): void {
    DB::table($this->table)
      ->permanentDelete()
      ->where($this->getPrimaryKey(), '=', (string) $id)
      ->execute();
  }

}