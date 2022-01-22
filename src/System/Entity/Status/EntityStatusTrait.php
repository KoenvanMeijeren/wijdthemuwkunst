<?php
declare(strict_types=1);

namespace System\Entity\Status;

use Components\Attribute\AttributeHelper;

/**
 * Provides a trait for the entity status behavior.
 *
 * @package \System\Entity\Status
 */
trait EntityStatusTrait {

  /**
   * Sets the status of an entity.
   *
   * @param int $status
   *   The status.
   *
   * @return \System\Entity\Status\EntityStatusInterface
   *   The called object reference.
   */
  protected function setStatusNumeric(int $status): EntityStatusInterface {
    $this->set($this->getEntityStatusColumn()->column, $status);
    return $this;
  }

  /**
   * Gets the entity status.
   *
   * @return int
   *   The entity status.
   */
  protected function getStatusNumeric(): int {
    return (int) $this->get($this->getEntityStatusColumn()->column);
  }

  /**
   * {@inheritdoc}
   */
  public function setStatus(EntityStatus $status): EntityStatusInterface {
    $this->setStatusNumeric($status->value);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getStatus(): EntityStatus {
    return EntityStatus::set($this->getStatusNumeric());
  }

  /**
   * {@inheritdoc}
   */
  public function isActive(): bool {
    return $this->getStatus()->isEqual(EntityStatus::ACTIVE);
  }

  /**
   * {@inheritdoc}
   */
  public function isDeleted(): bool {
    return $this->getStatus()->isEqual(EntityStatus::DELETED);
  }

  /**
   * Gets the entity status column attribute.
   *
   * @return \System\Entity\Status\EntityStatusColumn
   *   The entity status column.
   */
  protected function getEntityStatusColumn(): EntityStatusColumn {
    return (new AttributeHelper($this))->getByClass(EntityStatusColumn::class);
  }

}
