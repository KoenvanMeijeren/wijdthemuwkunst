<?php

namespace Domain\Admin\Event\ViewModels;

use Components\Translation\TranslationOld;
use Domain\Admin\Event\Repositories\EventRepository;
use Domain\Admin\Event\Support\EventDatetimeConverter;
use Components\Resource\Resource;
use System\DataTable\DataTableBuilder;

/**
 *
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
   */
  protected function buildRow(object $data): array {
    $event = new EventRepository($data);

    $dateTime = new EventDatetimeConverter($event->getDatetime());
    $slug = "<a href='/concerten/historie/concert/{$event->getSlug()}' target='_blank'>{$event->getSlug()}</a>";

    return [
      $slug,
      $event->getTitle(),
      $event->getLocation(),
      $dateTime->toReadable(),
    ];
  }

  /**
   * @inheritDoc
   */
  protected function buildRowActions(object $data): string {
    $event = new EventRepository($data);

    $actions = '<div class="table-edit-row flex">';
    $actions .= Resource::addTableButtonActionColumn(
          '/admin/content/events/event/activate/' . $event->getId(),
          'Activeren',
          'fas fa-history',
          'btn-outline-success'
      );
    $actions .= Resource::addTableButtonActionColumn(
          '/admin/content/events/event/delete/' . $event->getId(),
          TranslationOld::get('table_row_delete'),
          'fas fa-trash-alt',
          'btn-outline-danger',
          TranslationOld::get('delete_event_confirmation_message')
      );
    $actions .= '</div>';

    return $actions;
  }

}
