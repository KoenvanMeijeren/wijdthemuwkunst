<?php

namespace Domain\Admin\Event\ViewModels;

use Domain\Admin\Event\Repositories\EventRepository;
use Domain\Admin\Event\Support\EventDatetimeConverter;
use Domain\Admin\Event\Support\EventIsPublishedStateConverter;
use Src\DataTable\DataTableBuilder;
use Src\Translation\Translation;
use Support\Resource;

/**
 *
 */
final class EventTable extends DataTableBuilder {

  /**
   * @inheritDoc
   */
  protected function buildHead(): array {
    return [
      Translation::get('table_row_slug'),
      Translation::get('table_row_location'),
      Translation::get('table_row_datetime'),
      Translation::get('table_row_publish_state'),
      Translation::get('table_row_edit'),
    ];
  }

  /**
   * @inheritDoc
   */
  protected function buildRow(object $data): array {
    $event = new EventRepository($data);

    $isPublishedState = new EventIsPublishedStateConverter(
          $event->isPublished()
      );
    $dateTime = new EventDatetimeConverter(
          $event->getDatetime()
      );
    if (!$event->isPublished()) {
      $this->dataTable->addClasses('row-warning');
    }

    $slug = "<a href='/concerten/concert/{$event->getSlug()}' target='_blank'>{$event->getSlug()}</a>";

    return [
      $slug,
      $event->getLocation(),
      $dateTime->toReadable(),
      $isPublishedState->toReadable(),
    ];
  }

  /**
   * @inheritDoc
   */
  protected function buildRowActions(object $data): string {
    $event = new EventRepository($data);

    $actions = '<div class="table-edit-row">';
    $actions .= Resource::addTableLinkActionColumn(
          '/admin/content/events/event/edit/' . $event->getId(),
          Translation::get('table_row_edit'),
          'fas fa-edit'
      );
    $actions .= Resource::addTableButtonActionColumn(
          '/admin/content/events/event/archive/' . $event->getId(),
          'Archiveren',
          'fas fa-archive',
          'btn-outline-warning',
          Translation::get('archive_event_confirmation_message')
      );
    $actions .= Resource::addTableButtonActionColumn(
          '/admin/content/events/event/delete/' . $event->getId(),
          Translation::get('table_row_delete'),
          'fas fa-trash-alt',
          'btn-outline-danger',
          Translation::get('delete_event_confirmation_message')
      );
    $actions .= '</div>';

    return $actions;
  }

}
