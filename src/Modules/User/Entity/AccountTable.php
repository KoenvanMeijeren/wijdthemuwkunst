<?php

declare(strict_types=1);


namespace Modules\User\Entity;

use Components\ComponentsTrait;
use Components\Resource\Resource;
use Components\Translation\TranslationOld;
use Modules\User\Support\AccountBlockStateConverter;
use Modules\User\Support\AccountRightsConverter;
use System\DataTable\DataTableBuilder;
use System\Entity\EntityInterface;

/**
 * Provides a table for account entities.
 *
 * @package Modules\User\Entity
 */
final class AccountTable extends DataTableBuilder {

  use ComponentsTrait;

  /**
   * {@inheritDoc}
   */
  protected function buildHead(): array {
    return [
      TranslationOld::get('table_row_name'),
      TranslationOld::get('table_row_email'),
      TranslationOld::get('table_row_rights'),
      TranslationOld::get('table_row_edit'),
    ];
  }

  /**
   * {@inheritDoc}
   *
   * @param \Modules\User\Entity\AccountInterface $entity
   *   The entity.
   */
  protected function buildRow(EntityInterface $entity): array {
    $rights = new AccountRightsConverter($entity->getRights());
    $blockState = new AccountBlockStateConverter($entity->isBlocked());

    if ($entity->isBlocked()) {
      $this->dataTable->addClasses('row-warning');
    }

    return [
      ucfirst($entity->getName()) . $blockState->toReadable(),
      lcfirst($entity->getEmail()),
      $rights->toReadable(),
    ];
  }

  /**
   * {@inheritDoc}
   *
   * @param \Modules\User\Entity\AccountInterface $entity
   *   The entity.
   */
  protected function buildRowActions(EntityInterface $entity): string {
    $current_user = $this->currentUser();

    $actions = '<div class="table-edit-row">';
    $actions .= Resource::addTableLinkActionColumn(
      '/admin/account/edit/' . $entity->id(),
      TranslationOld::get('table_row_edit'),
      'fas fa-edit'
    );
    $actions .= Resource::addTableButtonActionColumn(
      '/admin/account/delete/' . $entity->id(),
      TranslationOld::get('table_row_delete'),
      'fas fa-trash-alt',
      'btn-outline-danger',
      TranslationOld::get('admin_delete_account_warning_message'),
      $current_user->id() === $entity->id()
    );
    $actions .= '</div>';

    return $actions;
  }

}
