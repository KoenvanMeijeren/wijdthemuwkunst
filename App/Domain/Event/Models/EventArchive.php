<?php

namespace Domain\Event\Models;

use Src\Database\DB;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

/**
 * Provides a model for the archive of the event table to interact with the database.
 *
 * @package Domain\Event\Models
 */
class EventArchive extends Model {
  use SoftDelete;

  protected string $table = 'event';
  protected string $foreignTable = 'slug';
  protected string $primaryKey = 'event_ID';
  protected string $foreignKey = 'event_slug_ID';
  protected string $primarySlugKey = 'slug_ID';
  protected string $datetimeKey = 'event_date';
  protected string $archivedKey = 'event_is_archived';
  protected string $softDeletedKey = 'event_is_deleted';
  protected string $slugKey = 'slug_name';
  protected string $slugSoftDeletedKey = 'slug_is_deleted';
  protected string $isPublishedKey = 'event_is_published';

  /**
   * EventArchive constructor.
   */
  public function __construct() {
    $this->addScope(
          (new DB)->innerJoin(
              $this->foreignTable,
              $this->primarySlugKey,
              $this->foreignKey
          )->where(
              $this->slugSoftDeletedKey,
              '=',
              '0'
          )->where(
              $this->isPublishedKey,
              '=',
              '1'
          )->where(
              $this->archivedKey,
              '=',
              '1'
          )
      );

    $this->initializeSoftDelete();
  }

  /**
   * Gets a limited number of events.
   *
   * @param int $limit
   *   The maximum of events to return.
   *
   * @return array
   *   The events.
   */
  public function getLimited(int $limit): array {
    $this->addScope(
          (new DB)->orderBy('asc', 'event_date')
            ->limit($limit)
      );

    return $this->all(['*']);
  }

  /**
   * Returns the number of available events.
   *
   * @return int
   *   The amount of found events.
   */
  public function getAmountOfEvents(): int {
    $this->scopes['query'] = '';
    $this->scopes['values'] = [];

    $this->__construct();
    $events = $this->all();

    return count($events);
  }

}
