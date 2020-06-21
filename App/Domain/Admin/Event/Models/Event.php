<?php

namespace Domain\Admin\Event\Models;

use Src\Database\DB;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;

/**
 * Provides a model for the event table to interact with the database.
 *
 * @package Domain\Admin\Event\Models
 */
final class Event extends Model {
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

  /**
   * Event constructor.
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
          )
      );

    $this->initializeSoftDelete();
  }

  /**
   * Gets all events.
   *
   * @return object[]
   *   The events.
   */
  public function getAll(): array {
    $this->addScope(
          (new DB)->where(
              $this->archivedKey,
              '=',
              '0'
          )->orderBy('asc', $this->datetimeKey)
      );

    return $this->all();
  }

  /**
   * Get all archived events.
   *
   * @return object[]
   *   The archived events.
   */
  public function getAllArchived(): array {
    if (array_key_exists('event_is_archived', $this->scopes['values'])) {
      $this->scopes['values']['event_is_archived'] = '1';
    }

    $this->addScope(
          (new DB)->where(
              $this->archivedKey,
              '=',
              '1'
          )->orderBy('asc', $this->datetimeKey)
      );

    return $this->all();
  }

}
