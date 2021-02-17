<?php

namespace Modules\Contact\Entity;

use Components\Datetime\DateTimeInterface;
use System\Entity\EntityRepositoryInterface;

/**
 * Provides an interface for contact form repositories.
 *
 * @package Modules\Contact\Entity
 */
interface ContactRepositoryInterface extends EntityRepositoryInterface {

  /**
   * Loads contact form entities for a given date.
   *
   * @param string $date
   *   The date to search for.
   *
   * @return ContactInterface[]|null
   *   The contact form entity or null.
   */
  public function loadByDate(string $date): ?array;

}
