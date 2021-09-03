<?php

namespace Modules\Event\Entity;

use Components\ComponentsTrait;
use Components\Resource\Resource;
use Components\Translation\TranslationOld;
use Modules\Event\Utility\EventDatetimeConverter;
use Modules\Event\Utility\EventIsPublishedStateConverter;
use System\DataTable\DataTableBuilder;
use System\Entity\EntityInterface;

/**
 * Provides a table for Page entities.
 *
 * @package Modules\Event\Entity
 */
final class EventTable extends DataTableBuilder {

  use ComponentsTrait;

  /**
   * {@inheritDoc}
   */
  protected function buildHead(): array {
    return [
      TranslationOld::get('table_row_slug'),
      TranslationOld::get('table_row_location'),
      TranslationOld::get('table_row_datetime'),
      TranslationOld::get('table_row_publish_state'),
      TranslationOld::get('table_row_actions'),
    ];
  }

  /**
   * {@inheritDoc}
   *
   * @param EventInterface $entity
   *   The entity.
   */
  protected function buildRow(EntityInterface $entity): array {
    $isPublishedState = new EventIsPublishedStateConverter($entity->isPublished());
    $dateTime = new EventDatetimeConverter($entity->getDateTime());
    if (!$entity->isPublished()) {
      $this->dataTable->addClasses('row-warning');
    }

    $slug = "<a href='/concerten/concert/{$entity->getSlug()}' class='text-white' target='_blank'>{$entity->getSlug()}</a>";

    return [
      $slug,
      $entity->getLocation(),
      $dateTime->toReadable(),
      $isPublishedState->toReadable(),
    ];
  }

  /**
   * {@inheritDoc}
   *
   * @param EventInterface $entity
   *   The entity.
   */
  protected function buildRowActions(EntityInterface $entity): string {
    $actions = '<div class="table-edit-row">';
    $actions .= Resource::addTableLinkActionColumn(
      '/admin/content/events/event/edit/' . $entity->id(),
      TranslationOld::get('table_row_edit'),
      'fas fa-edit'
    );
    $actions .= Resource::addTableButtonActionColumn(
      '/admin/content/events/event/archive/' . $entity->id(),
      'Archiveren',
      'fas fa-archive',
      'btn-outline-warning',
      TranslationOld::get('archive_event_confirmation_message')
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
