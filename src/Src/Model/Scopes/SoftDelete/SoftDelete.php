<?php

declare(strict_types=1);


namespace Src\Model\Scopes\SoftDelete;

use Src\Database\DB;

/**
 * Provides a trait for sub classes who uses soft delete.
 *
 * @package src\Model\Scopes\SoftDelete
 */
trait SoftDelete {

  /**
   * Adds a scope to the query.
   *
   * @param \Src\Database\DB $builder
   *   The query builder.
   */
  abstract protected function addScope(DB $builder): void;

  /**
   * Initializes the soft delete scope.
   *
   * @param string $softDeletedKey
   *   The name of the is deleted column.
   */
  public function initializeSoftDelete(string $softDeletedKey = NULL): void {
    if ($softDeletedKey === NULL) {
      $softDeletedKey = $this->softDeletedKey;
    }

    $this->addScope(
      (new DB)->where($softDeletedKey, '=', '0')
    );
  }

}
