<?php

namespace Src\Model;

/**
 * Defines an interface for entity models.
 *
 * @package Src\Model
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

}
