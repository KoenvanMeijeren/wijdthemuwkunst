<?php

namespace Modules\Page\Entity;

use Components\ComponentsTrait;
use Components\Translation\Translation;
use Domain\Admin\Accounts\User\Models\User;
use Components\Translation\TranslationOld;
use Components\Resource\Resource;
use System\DataTable\DataTableBuilder;
use System\Entity\EntityInterface;

/**
 * Provides a table for Page entities.
 *
 * @package Modules\Page\Entity
 */
final class PageTable extends DataTableBuilder {

  use ComponentsTrait;

  /**
   * {@inheritDoc}
   */
  protected function buildHead(): array {
    return [
      TranslationOld::get('table_row_slug'),
      TranslationOld::get('table_row_title'),
      TranslationOld::get('table_row_page_in_menu'),
      TranslationOld::get('table_row_publish_state'),
      TranslationOld::get('table_row_actions'),
    ];
  }

  /**
   * {@inheritDoc}
   *
   * @param PageInterface $entity
   *   The entity.
   */
  protected function buildRow(EntityInterface $entity): array {
    $inMenu = match ($entity->getInMenu()) {
      PageInterface::PAGE_NORMAL => TranslationOld::get('page_normal'),
      PageInterface::PAGE_STATIC => TranslationOld::get('page_static'),
      default => TranslationOld::get('page_in_menu_state_unknown'),
    };

    return [
      "<a target='_blank' href='/{$entity->getSlug()}'>{$entity->getSlug()}</a>",
      $entity->getTitle(),
      $inMenu,
      $entity->isPublished() ? TranslationOld::get('admin_page_is_published') : TranslationOld::get('admin_page_is_not_published'),
    ];
  }

  /**
   * {@inheritDoc}
   *
   * @param PageInterface $entity
   *   The entity.
   */
  protected function buildRowActions(EntityInterface $entity): string {
    return Resource::addTableEditColumn(
      '/admin/content/pages/page/edit/' . $entity->id(),
      '/admin/content/pages/page/delete/' . $entity->id(),
      sprintf(
        TranslationOld::get('delete_page_confirmation_message'),
        $entity->getTitle()
      ),
      $this->currentUser()->getRights() !== User::DEVELOPER
    );
  }

}