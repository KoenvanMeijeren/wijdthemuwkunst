<?php

namespace Modules\Contact\Entity;

use Cake\Chronos\Chronos;
use Components\Database\Query;
use System\Entity\EntityRepositoryBase;

/**
 * Defines a repository for contact entities.
 *
 * @package Modules\Contact\Entity
 */
final class ContactRepository extends EntityRepositoryBase implements ContactRepositoryInterface {

  /**
   * {@inheritDoc}
   */
  public function loadByDate(string $date): ?array {
    $datetime = new Chronos($date);
    $start = $datetime->toDateString() . ' 00:00:00';
    $end = $datetime->toDateString() . ' 23:59:59';

    $this->query = new Query($this->entity->getTable());
    $this->query->select('*');
    $this->query->whereBetween($this->entity->getTable() . '_created_at', $start, $end);

    $this->addGlobalFilters();

    return $this->query->allToClass($this->entity::class);
  }

}
