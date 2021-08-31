<?php

namespace Modules\Event\Entity;

use Modules\Slug\SlugTrait;
use System\Entity\EntityInterface;
use System\Entity\EntityRepositoryBase;

/**
 * Defines a repository for Event entities.
 *
 * @package Modules\Event\Entity
 */
final class EventRepository extends EntityRepositoryBase implements EventRepositoryInterface {

  use SlugTrait;

  /**
   * Determines if the events must be archived or not.
   *
   * @var bool
   */
  protected bool $archivedEvents = FALSE;

  /**
   * {@inheritDoc}
   */
  public function all(array $columns = ['*'], bool $archived = FALSE): array {
    $this->archivedEvents = $archived;

    return parent::all($columns);
  }

  /**
   * {@inheritDoc}
   */
  public function firstByAttributes(array $attributes, array $columns = ['*'], bool $archived = FALSE): ?EntityInterface {
    $this->archivedEvents = $archived;

    return parent::firstByAttributes($attributes, $columns);
  }

  /**
   * {@inheritDoc}
   */
  protected function addGlobalFilters(): void {
    $this->addSlugJoin($this->query, 'event_slug_ID');
    $this->addSlugFilter($this->query);

    $this->query->where('event_is_archived', '=', (string) $this->archivedEvents);

    parent::addGlobalFilters();
  }

}
