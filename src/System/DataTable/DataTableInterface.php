<?php

namespace System\DataTable;

/**
 * Provides an interface for data table builders on a HTML level.
 *
 * @package System\DataTable
 */
interface DataTableInterface {

  /**
   * Adds a head to the table.
   *
   * @param string[] $ths
   *   Each item represents a title for a column.
   */
  public function addHead(array $ths): void;

  /**
   * Adds a row to the table.
   *
   * @param string[] $tds
   *   Each item represent a piece of data in a row.
   * @param string $actions
   *   The renderable actions.
   */
  public function addRow(array $tds, string $actions = ''): void;

  /**
   * Adds a footer to the table.
   *
   * @param string[] $ths
   *   Each item represent a head for a column.
   */
  public function addFooter(array $ths): void;

  /**
   * Gets the build table.
   *
   * @param string $id
   *   The ID of the table.
   *
   * @return string
   *   The renderable table.
   */
  public function get(string $id = 'table'): string;

  /**
   * Add (multiple) ids to a piece of html.
   *
   * @param string $ids
   *   The IDs of the HTML piece.
   */
  public function addId(...$ids): void;

  /**
   * Add (multiple) classes to a piece of html.
   *
   * @param string $classes
   *   The HTML classes.
   */
  public function addClasses(...$classes): void;

}
