<?php

declare(strict_types=1);


namespace Domain\Admin\Pages\ViewModels;

use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Pages\Models\Page;
use Domain\Admin\Pages\Repositories\PageRepository;
use Domain\Admin\Pages\Support\PageInMenuStateConverter;
use Domain\Admin\Pages\Support\PageIsPublishedStateConverterBase;
use Src\Translation\Translation;
use Support\Resource;
use System\DataTable\DataTableBuilder;

/**
 *
 */
final class PageTable extends DataTableBuilder {

  /**
   * @inheritDoc
   */
  protected function buildHead(): array {
    return [
      Translation::get('table_row_slug'),
      Translation::get('table_row_title'),
      Translation::get('table_row_page_in_menu'),
      Translation::get('table_row_publish_state'),
      Translation::get('table_row_edit'),
    ];
  }

  /**
   * @inheritDoc
   */
  protected function buildRow(object $data): array {
    $page = new PageRepository($data);
    $inMenuState = new PageInMenuStateConverter(
          $page->getInMenu()
      );
    $isPublishedState = new PageIsPublishedStateConverterBase(
          $page->isPublished()
      );

    if (!$page->isPublished()) {
      $this->dataTable->addClasses('row-warning');
    }

    $slug = "<a href='/{$page->getSlug()}' target='_blank'>{$page->getSlug()}</a>";

    return [
      $slug,
      $page->getTitle(),
      $inMenuState->toReadable(),
      $isPublishedState->toReadable(),
    ];
  }

  /**
   * @inheritDoc
   */
  protected function buildRowActions(object $data): string {
    $page = new PageRepository($data);
    $user = new User();

    $actions = '<div class="table-edit-row">';
    $actions .= Resource::addTableLinkActionColumn(
          '/admin/content/pages/page/edit/' . $page->getId(),
          Translation::get('table_row_edit'),
          'fas fa-edit'
      );
    $actions .= Resource::addTableButtonActionColumn(
          '/admin/content/pages/page/delete/' . $page->getId(),
          Translation::get('table_row_delete'),
          'fas fa-trash-alt',
          'btn-outline-danger',
          Translation::get('delete_page_confirmation_message'),
          $user->getRights() !== User::DEVELOPER
          && $page->getInMenu() !== Page::PAGE_STATIC
      );
    $actions .= '</div>';

    return $actions;
  }

}
