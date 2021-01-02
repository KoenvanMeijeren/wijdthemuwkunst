<?php

namespace System\Entity\Model;

/**
 * Defines an interface for entity models.
 *
 * @package src\Model
 */
interface EntityModelInterface {

  /**
   * Returns the name of the table.
   *
   * @return string
   *   The table name.
   */
  public function getTable(): string;

  /**
   * Returns the primary key of the table.
   *
   * @return string
   *   The name of the primary key.
   */
  public function getPrimaryKey(): string;

  /**
   * Returns the name of the is deleted column of the table.
   *
   * @return string
   *   The name of the is deleted column.
   */
  public function getSoftDeletedKey(): string;

}
