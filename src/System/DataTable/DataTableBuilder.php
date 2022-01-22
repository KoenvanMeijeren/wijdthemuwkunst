<?php

declare(strict_types=1);

namespace System\DataTable;

use System\Entity\EntityInterface;

/**
 * Provides a class for building data tables.
 *
 * @package src\DataTable
 */
abstract class DataTableBuilder implements DataTableBuilderInterface {

  /**
   * DataTableBuilder constructor.
   *
   * @param \System\Entity\EntityInterface[] $entities
   *   The entities.
   * @param \System\DataTable\DataTable $dataTable
   *   The datatable definition.
   */
  public function __construct(
    protected array $entities,
    protected DataTable $dataTable = new DataTable()
  ) {}

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
   * @param \System\Entity\EntityInterface $entity
   *   The entity.
   *
   * @return string[]
   *   The rows with data.
   */
  abstract protected function buildRow(EntityInterface $entity): array;

  /**
   * Build the actions for one row.
   *
   * @param \System\Entity\EntityInterface $entity
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

    return $this->dataTable->render($id);
  }

}
