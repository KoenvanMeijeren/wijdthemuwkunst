<?php

namespace Domain\Event\Models;

use Components\Database\Query;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

/**
 * Provides a model for the event archive table to interact with the database.
 *
 * @package Domain\Event\Models
 */
class EventArchive extends Model {

  use SoftDelete;

  /**
   * The name of the table.
   *
   * @var string
   */
  protected string $table = 'event';

  /**
   * The name of the foreign table.
   *
   * @var string
   */
  protected string $foreignTable = 'slug';

  /**
   * The primary key of the table.
   *
   * @var string
   */
  protected string $primaryKey = 'event_ID';

  /**
   * The foreign key of the slug of the table.
   *
   * @var string
   */
  protected string $foreignKey = 'event_slug_ID';

  /**
   * The primary key of the slug table.
   *
   * @var string
   */
  protected string $primarySlugKey = 'slug_ID';

  /**
   * The key of the date column.
   *
   * @var string
   */
  protected string $datetimeKey = 'event_date';

  /**
   * The key of the is archived column.
   *
   * @var string
   */
  protected string $archivedKey = 'event_is_archived';

  /**
   * The key of the is published column of the table.
   *
   * @var string
   */
  protected string $isPublishedKey = 'event_is_published';

  /**
   * The key of the is deleted column.
   *
   * @var string
   */
  protected string $softDeletedKey = 'event_is_deleted';

  /**
   * The key of the slug column of the slug table.
   *
   * @var string
   */
  protected string $slugKey = 'slug_name';

  /**
   * The key of the slug is deleted column of the slug table.
   *
   * @var string
   */
  protected string $slugSoftDeletedKey = 'slug_is_deleted';

  /**
   * EventArchive constructor.
   */
  public function __construct() {
    $this->addScope((new Query($this->table))
      ->innerJoin($this->foreignTable, $this->primarySlugKey, $this->foreignKey)
      ->where($this->slugSoftDeletedKey, '=', '0')
      ->where($this->isPublishedKey, '=', '1')
      ->where($this->archivedKey, '=', '1')
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
    $this->addScope((new Query($this->table))
      ->orderBy('asc', 'event_date')
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
