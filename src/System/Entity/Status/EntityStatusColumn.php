<?php
declare(strict_types=1);

namespace System\Entity\Status;

/**
 * Provides an attribute for entity status columns.
 *
 * @package \System\Entity\Status
 */
#[\Attribute]
class EntityStatusColumn {

  /**
   * Constructs the entity status column.
   *
   * @param string $column
   *   The status column.
   */
  public function __construct(
    public string $column
  ) {
  }

}
