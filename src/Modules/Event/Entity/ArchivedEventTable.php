<?php
declare(strict_types=1);

namespace Modules\Event\Entity;

use Components\Translation\TranslationOld;
use Components\Resource\Resource;
use Modules\Event\Utility\EventDatetimeConverter;
use System\DataTable\DataTableBuilder;
use System\Entity\EntityInterface;

/**
 * Provides a table for archived events.
 *
 * @package Modules\Event\Entity
 */
final class ArchivedEventTable extends DataTableBuilder {

  /**
   * @inheritDoc
   */
  protected function buildHead(): array {
    return [
      TranslationOld::get('table_row_slug'),
      TranslationOld::get('table_row_title'),
      TranslationOld::get('table_row_location'),
      TranslationOld::get('table_row_datetime'),
      TranslationOld::get('table_row_edit'),
    ];
  }

  /**
   * @inheritDoc
   *
   * @param \Modules\Event\Entity\EventInterface $entity
   *   The entity.
   */
  protected function buildRow(EntityInterface $entity): array {
    $dateTime = new EventDatetimeConverter($entity->getDateTime());
    $slug = "<a href='/concerten/historie/concert/{$entity->getSlug()}' target='_blank'>{$entity->getSlug()}</a>";

    return [
      $slug,
      $entity->getTitle(),
      $entity->getLocation(),
      $dateTime->toReadable(),
    ];
  }

  /**
   * @inheritDoc
   *
   * @param \Modules\Event\Entity\EventInterface $entity
   *   The entity.
   */
  protected function buildRowActions(EntityInterface $entity): string {
    $actions = '<div class="table-edit-row flex">';
    $actions .= Resource::addTableButtonActionColumn(
          '/admin/content/events/event/activate/' . $entity->id(),
          'Activeren',
          'fas fa-history',
          'btn-outline-success'
      );
    $actions .= Resource::addTableButtonActionColumn(
          '/admin/content/events/event/delete/' . $entity->id(),
          TranslationOld::get('table_row_delete'),
          'fas fa-trash-alt',
          'btn-outline-danger',
          TranslationOld::get('delete_event_confirmation_message')
      );
    $actions .= '</div>';

    return $actions;
  }

}
