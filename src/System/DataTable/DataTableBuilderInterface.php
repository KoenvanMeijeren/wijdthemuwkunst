<?php

namespace System\DataTable;

/**
 * Provides an interface for data table builders on a entity output level.
 *
 * @package System\DataTable
 */
interface DataTableBuilderInterface {

  /**
   * Gets the build table.
   *
   * @param string $id
   *   The id of the table.
   *
   * @return string
   *   The renderable table.
   */
  public function get(string $id = 'table'): string;

}
