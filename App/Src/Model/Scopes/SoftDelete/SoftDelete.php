<?php

declare(strict_types=1);


namespace Src\Model\Scopes\SoftDelete;

use Src\Database\DB;

/**
 * Provides a trait for sub classes who uses soft delete.
 *
 * @package Src\Model\Scopes\SoftDelete
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
   */
  public function initializeSoftDelete(): void {
    $this->addScope(
          (new DB)->where($this->softDeletedKey, '=', '0')
      );
  }

}
