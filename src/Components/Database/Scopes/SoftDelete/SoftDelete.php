<?php
declare(strict_types=1);

namespace Components\Database\Scopes\SoftDelete;

/**
 * Provides a trait for subclasses who use soft delete.
 *
 * @package src\Model\Scopes\SoftDelete
 */
trait SoftDelete {

  /**
   * Initializes the soft delete scope.
   *
   * @param string $softDeletedKey
   *   The name of the is deleted column.
   */
  public function initializeSoftDelete(string $softDeletedKey): void {
    $this->query->where($softDeletedKey, '=', '0');
  }

}
