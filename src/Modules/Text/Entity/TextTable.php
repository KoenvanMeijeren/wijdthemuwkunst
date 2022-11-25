<?php

namespace Modules\Text\Entity;

use Components\ComponentsTrait;
use Components\Resource\Resource;
use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use System\DataTable\DataTableBuilder;
use System\Entity\EntityInterface;

/**
 * Provides a table for text entities.
 *
 * @package Domain\Admin\Text\Entity
 */
final class TextTable extends DataTableBuilder {

  use ComponentsTrait;

  /**
   * {@inheritDoc}
   */
  protected function buildHead(): array {
    return [
      TranslationOld::get('table_row_key'),
      TranslationOld::get('table_row_value'),
      TranslationOld::get('table_row_edit'),
    ];
  }

  /**
   * {@inheritDoc}
   *
   * @param TextInterface $entity
   *   The entity.
   */
  protected function buildRow(EntityInterface $entity): array {
    return [
      $entity->getKey(),
      $entity->getValue(),
    ];
  }

  /**
   * {@inheritDoc}
   *
   * @param TextInterface $entity
   *   The entity.
   */
  protected function buildRowActions(EntityInterface $entity): string {
    return Resource::addTableEditColumn(
      '/admin/configuration/texts/text/edit/' . $entity->id(),
      '/admin/configuration/texts/text/delete/' . $entity->id(),
      sprintf(
        TranslationOld::get('delete_text_confirmation_message'),
        $entity->getKey()
      ),
      $this->currentUser()->getRouteRights()->hasAccessForbidden(RouteRights::DEVELOPER)
    );
  }

}
