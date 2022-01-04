<?php
declare(strict_types=1);

namespace System\Entity\Model;

use Components\Database\Query;
use Components\Database\QueryInterface;
use JetBrains\PhpStorm\Pure;
use System\Entity\Status\EntityStatus;

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
   * The query definition.
   *
   * @var QueryInterface
   */
  private QueryInterface $query;

  /**
   * {@inheritDoc}
   */
  public function getTable(): string {
    return $this->table;
  }

  /**
   * {@inheritDoc}
   */
  #[Pure] public function getPrimaryKey(): string {
    return "{$this->getTable()}_ID";
  }

  /**
   * {@inheritDoc}
   */
  #[Pure] public function getSoftDeletedKey(): string {
    return "{$this->getTable()}_is_deleted";
  }

  /**
   * Creates a new record.
   *
   * @param string[] $attributes
   */
  protected function create(array $attributes): void {
    $this->query = new Query($this->getTable());
    $this->query->insert($attributes);
  }

  /**
   * Updates a record.
   *
   * @param int $id
   * @param string[] $attributes
   */
  protected function update(int $id, array $attributes): void {
    $this->query = new Query($this->getTable());
    $this->query->update($attributes)
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
    $this->query = new Query($this->getTable());
    $this->query->delete($this->getSoftDeletedKey(), EntityStatus::DELETED->value)
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
    $this->query = new Query($this->getTable());
    $this->query->permanentDelete()
      ->where($this->getPrimaryKey(), '=', (string) $id)
      ->execute();
  }

}
