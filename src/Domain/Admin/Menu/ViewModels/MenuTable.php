<?php

namespace Domain\Admin\Menu\ViewModels;

use Components\Translation\TranslationOld;
use Domain\Admin\Menu\Repositories\MenuRepository;
use Components\Resource\Resource;
use System\DataTable\DataTableBuilder;

/**
 *
 */
final class MenuTable extends DataTableBuilder {

  /**
   * @inheritDoc
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
   * @inheritDoc
   */
  protected function buildRow(object $data): array {
    $menuItem = new MenuRepository($data);

    $slug = "<a href='/{$menuItem->getSlug()}' target='_blank'>{$menuItem->getTitle()}</a>";

    return [
      $slug,
      $menuItem->getTitle(),
      (string) $menuItem->getWeight(),
    ];
  }

  /**
   * @inheritDoc
   */
  protected function buildRowActions(object $data): string {
    $menuItem = new MenuRepository($data);

    $actions = '<div class="table-edit-row flex">';
    $actions .= Resource::addTableLinkActionColumn(
          '/admin/structure/menu/item/edit/' . $menuItem->getId(),
          TranslationOld::get('table_row_edit'),
          'fas fa-edit'
      );
    $actions .= Resource::addTableButtonActionColumn(
          '/admin/structure/menu/item/delete/' . $menuItem->getId(),
          TranslationOld::get('table_row_delete'),
          'fas fa-trash-alt',
          'btn-outline-danger',
          sprintf(
              TranslationOld::get('delete_menu_item_confirmation_message'),
              $menuItem->getTitle()
          )
      );
    $actions .= '</div>';

    return $actions;
  }

}
