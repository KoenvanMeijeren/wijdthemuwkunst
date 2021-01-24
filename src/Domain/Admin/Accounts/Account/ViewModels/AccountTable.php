<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\ViewModels;

use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\Account\Support\AccountBlockStateConverter;
use Domain\Admin\Accounts\Account\Support\AccountRightsConverter;
use Domain\Admin\Accounts\Repositories\AccountRepository;
use Domain\Admin\Accounts\User\Models\User;
use Src\Resource\Resource;
use System\DataTable\DataTableBuilder;

/**
 *
 */
final class AccountTable extends DataTableBuilder {

  /**
   * @inheritDoc
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
   * @inheritDoc
   */
  protected function buildRow(object $data): array {
    $account = new AccountRepository($data);

    $rights = new AccountRightsConverter($account->getRights());
    $blockState = new AccountBlockStateConverter($account->isBlocked());

    if ($account->isBlocked()) {
      $this->dataTable->addClasses('row-warning');
    }

    return [
      ucfirst($account->getName()) . $blockState->toReadable(),
      lcfirst($account->getEmail()),
      $rights->toReadable(),
    ];
  }

  /**
   * @inheritDoc
   */
  protected function buildRowActions(object $data): string {
    $account = new AccountRepository($data);
    $user = new User();

    $actions = '<div class="table-edit-row">';
    $actions .= Resource::addTableLinkActionColumn(
          '/admin/account/edit/' . $account->getId(),
          TranslationOld::get('table_row_edit'),
          'fas fa-edit'
      );
    $actions .= Resource::addTableButtonActionColumn(
          '/admin/account/delete/' . $account->getId(),
          TranslationOld::get('table_row_delete'),
          'fas fa-trash-alt',
          'btn-outline-danger',
          TranslationOld::get('admin_delete_account_warning_message'),
          $user->getId() === $account->getId()
      );
    $actions .= '</div>';

    return $actions;
  }

}
