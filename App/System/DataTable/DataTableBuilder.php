<?php

declare(strict_types=1);

namespace System\DataTable;

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
   * The data to be used in the table.
   *
   * @var mixed[]
   */
  protected array $data = [];

  /**
   * DataTableBuilder constructor.
   *
   * @param string[] $data
   *   The table data.
   */
  public function __construct(array $data) {
    $this->dataTable = new DataTable();

    $this->data = $data;
  }

  /**
   * Build the head of the table.
   *
   * @return string[]
   *   The head items.
   */
  abstract protected function buildHead(): array;

  /**
   * Build one row with data.
   *
   * @param object $data
   *   The table data.
   *
   * @return string[]
   *   The rows with data.
   */
  abstract protected function buildRow(object $data): array;

  /**
   * Build the actions for one row.
   *
   * @param object $data
   *   The table data.
   *
   * @return string
   *   The renderable actions.
   */
  abstract protected function buildRowActions(object $data): string;

  /**
   * {@inheritDoc}
   */
  final public function get(string $id = 'table'): string {
    $this->dataTable->addHead($this->buildHead());

    foreach ($this->data as $item) {
      $this->dataTable->addRow(
        $this->buildRow($item),
        $this->buildRowActions($item)
      );
    }

    return $this->dataTable->get($id);
  }

}
