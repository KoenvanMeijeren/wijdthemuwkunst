<?php

declare(strict_types=1);


namespace Src\Model\Scopes\SoftDelete;

use Components\Database\Query;
use Components\Database\QueryInterface;

/**
 * Provides a trait for sub classes who uses soft delete.
 *
 * @package src\Model\Scopes\SoftDelete
 */
trait SoftDelete {

  /**
   * Adds a scope to the query.
   *
   * @param \Components\Database\QueryInterface $builder
   *   The query builder.
   */
  abstract protected function addScope(QueryInterface $builder): void;

  /**
   * Initializes the soft delete scope.
   *
   * @param string|null $softDeletedKey
   *   The name of the is deleted column.
   */
  public function initializeSoftDelete(string $softDeletedKey = NULL): void {
    if ($softDeletedKey === NULL) {
      $softDeletedKey = $this->softDeletedKey;
    }

    $this->addScope(
      (new Query($this->table))->where($softDeletedKey, '=', '0')
    );
  }

}
