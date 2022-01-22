<?php

namespace System\Entity\Status;

use JetBrains\PhpStorm\Pure;

/**
 * Provides an enumeration for the status of an entity. E.g. active or inactive.
 *
 * @package \System\Entity\Status
 */
enum EntityStatus: int {
  case ACTIVE = 0;
  case DELETED = 1;

  /**
   * Sets the entity status.
   *
   * @param int $status
   *   The status.
   *
   * @return \System\Entity\Status\EntityStatus
   *   The entity status visibility.
   *
   * @throws \System\Entity\Status\InvalidEntityStatusException
   */
  public static function set(int $status): EntityStatus {
    return match ($status) {
      self::ACTIVE->value => self::ACTIVE,
      self::DELETED->value => self::DELETED,
      default => throw new InvalidEntityStatusException($status),
    };
  }

  /**
   * Determines if the status is equal or not.
   *
   * @param int $status
   *   The status.
   *
   * @return bool
   *   Whether the status is equal or not.
   */
  #[Pure]
  public function isEqualNumeric(int $status): bool {
    return $this->value === $status;
  }

  /**
   * Determines if the status is equal or not.
   *
   * @param \System\Entity\Status\EntityStatus $status
   *   The status.
   *
   * @return bool
   *   Whether the status is equal or not.
   */
  #[Pure]
  public function isEqual(EntityStatus $status): bool {
    return $this->isEqualNumeric($status->value);
  }

}
