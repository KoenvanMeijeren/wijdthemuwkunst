<?php
declare(strict_types=1);

namespace System\Entity\Model;

use Components\Attribute\AttributeHelper;
use Components\Database\Query;
use Components\Database\QueryInterface;
use JetBrains\PhpStorm\Pure;
use System\Entity\Status\EntityStatus;
use System\Entity\Type\ContentEntityType;

/**
 * Provides a model for entities to interact with the database.
 *
 * @package src\Model
 */
abstract class EntityModelBase implements EntityModelInterface {

  /**
   * The query definition.
   *
   * @var QueryInterface
   */
  private QueryInterface $query;

  /**
   * The content entity type.
   *
   * @var \System\Entity\Type\ContentEntityType
   */
  protected ContentEntityType $contentEntityType;

  /**
   * Constructs the entity model.
   */
  public function __construct() {
    $this->initialize();
  }

  /**
   * Initializes the entity.
   */
  protected function initialize(): void {
    $contentEntityType = (new AttributeHelper($this))->getAttribute(ContentEntityType::class);
    if (!$contentEntityType instanceof ContentEntityType) {
      $class_name = get_class($this);
      throw new \InvalidArgumentException("The entity {$class_name} does not have a content type specified.");
    }

    $this->contentEntityType = $contentEntityType;
  }

  /**
   * {@inheritDoc}
   */
  public function getTable(): string {
    if (!isset($this->contentEntityType)) {
      $this->initialize();
    }

    return $this->contentEntityType->table;
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
