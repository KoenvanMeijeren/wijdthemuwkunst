<?php
declare(strict_types=1);

namespace System\Entity\Status;

use System\Entity\EntityInterface;

/**
 * Provides an interface for the entity status behavior.
 *
 * @package \System\Entity\Status
 */
interface EntityStatusInterface extends EntityInterface {

  /**
   * Sets the status of an entity.
   *
   * @param \System\Entity\Status\EntityStatus $status
   *   The status.
   *
   * @return $this
   *   The called object reference.
   */
  public function setStatus(EntityStatus $status): EntityStatusInterface;

  /**
   * Gets the entity status.
   *
   * @return \System\Entity\Status\EntityStatus
   *   The entity status.
   */
  public function getStatus(): EntityStatus;

  /**
   * If the entity is active.
   *
   * @return bool
   *   Whether the entity is active or not.
   */
  public function isActive(): bool;

  /**
   * If the entity is deleted.
   *
   * @return bool
   *   Whether the entity is deleted or not.
   */
  public function isDeleted(): bool;
}
