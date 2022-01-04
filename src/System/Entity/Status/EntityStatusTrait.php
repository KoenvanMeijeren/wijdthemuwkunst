<?php
declare(strict_types=1);

namespace System\Entity\Status;

/**
 * Provides a trait for the entity status behavior.
 *
 * @package \System\Entity\Status
 */
trait EntityStatusTrait {

  /**
   * {@inheritdoc}
   */
  public function setStatusNumeric(int $status): EntityStatusInterface {
    $this->set($this->getEntityStatusColumn()->column, $status);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getStatusNumeric(): int {
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
    $reflectionClass = new \ReflectionClass($this);
    $attributes = $reflectionClass->getAttributes(EntityStatusColumn::class);

    return reset($attributes);
  }

}
