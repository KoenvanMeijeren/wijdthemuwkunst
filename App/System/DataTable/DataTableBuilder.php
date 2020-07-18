<?php

declare(strict_types=1);

namespace System\DataTable;

use System\Entity\EntityInterface;

/**
 * Provides a class for building data tables.
 *
 * @package Src\DataTable
 */
abstract class DataTableBuilder implements DataTableBuilderInterface {

  /**
   * The datatable definition.
   *
   * @var DataTable
   */
  protected DataTable $dataTable;

  /**
   * The entities.
   *
   * @var mixed[]
   */
  protected array $entities = [];

  /**
   * DataTableBuilder constructor.
   *
   * @param EntityInterface[] $entities
   *   The entities.
   */
  public function __construct(array $entities) {
    $this->dataTable = new DataTable();

    $this->entities = $entities;
  }

  /**
   * Build the head of the table.
   *
   * @return string[]
   *   The head items.
   */
  abstract protected function buildHead(): array;

  /**
   * Build one row for an entity.
   *
   * @param EntityInterface $entity
   *   The entity.
   *
   * @return string[]
   *   The rows with data.
   */
  abstract protected function buildRow(EntityInterface $entity): array;

  /**
   * Build the actions for one row.
   *
   * @param EntityInterface $entity
   *   The entity.
   *
   * @return string
   *   The renderable actions.
   */
  abstract protected function buildRowActions(EntityInterface $entity): string;

  /**
   * {@inheritDoc}
   */
  final public function get(string $id = 'table'): string {
    $this->dataTable->addHead($this->buildHead());

    foreach ($this->entities as $entity) {
      $this->dataTable->addRow(
        $this->buildRow($entity),
        $this->buildRowActions($entity)
      );
    }

    return $this->dataTable->get($id);
  }

}
