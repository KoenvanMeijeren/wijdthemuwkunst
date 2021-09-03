<?php

namespace Modules\Menu\Entity;

use Components\ComponentsTrait;
use Components\Resource\Resource;
use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\User\Models\User;
use System\DataTable\DataTableBuilder;
use System\Entity\EntityInterface;

/**
 * Provides a table for Menu entities.
 *
 * @package Modules\Menu\Entit
 */
final class MenuTable extends DataTableBuilder {

  use ComponentsTrait;

  /**
   * {@inheritDoc}
   */
  protected function buildHead(): array {
    return [
      TranslationOld::get('table_row_slug'),
      TranslationOld::get('table_row_title'),
      TranslationOld::get('table_row_menu_item_weight'),
      TranslationOld::get('table_row_edit'),
    ];
  }

  /**
   * {@inheritDoc}
   *
   * @param MenuInterface $entity
   *   The entity.
   */
  protected function buildRow(EntityInterface $entity): array {
    return [
      $entity->getSlug(),
      $entity->getTitle(),
      $entity->getWeight(),
    ];
  }

  /**
   * {@inheritDoc}
   *
   * @param MenuInterface $entity
   *   The entity.
   */
  protected function buildRowActions(EntityInterface $entity): string {
    return Resource::addTableEditColumn(
      '/admin/structure/menu/item/edit/' . $entity->id(),
      '/admin/structure/menu/item/delete/' . $entity->id(),
      sprintf(
        TranslationOld::get('delete_menu_item_confirmation_message'),
        $entity->getTitle()
      ),
      $this->currentUser()->getRights() !== User::DEVELOPER
    );
  }

}
