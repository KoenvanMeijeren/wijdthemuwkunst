<?php
declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\ViewModels;

use Domain\Admin\Accounts\Account\Support\AccountBlockStateConverter;
use Domain\Admin\Accounts\Account\Support\AccountRightsConverter;
use Domain\Admin\Accounts\Repositories\AccountRepository;
use Domain\Admin\Accounts\User\Models\User;
use Src\Translation\Translation;
use Support\DataTable;
use Support\Resource;

final class IndexViewModel
{
    /**
     * @var object[]
     */
    private array $accounts;

    private DataTable $dataTable;
    private User $user;

    /**
     * @param object[] $accounts
     */
    public function __construct(array $accounts)
    {
        $this->accounts = $accounts;
        $this->dataTable = new DataTable();
        $this->user = new User();
    }

    public function table(): string
    {
        $this->dataTable->addEditHead('Naam', 'Email', 'Rechten');

        foreach ($this->accounts as $singleAccount) {
            $account = new AccountRepository($singleAccount);
            $rights = new AccountRightsConverter($account->getRights());
            $blockState = new AccountBlockStateConverter($account->isBlocked());

            if ($account->isBlocked()) {
                $this->dataTable->addClasses('row-warning');
            }

            $actions = '<div class="table-edit-row flex">';
            $actions .= Resource::addTableLinkActionColumn(
                '/admin/account/edit/' . $account->getId(),
                Translation::get('table_row_edit'),
                'fas fa-edit'
            );
            $actions .= Resource::addTableButtonActionColumn(
                '/admin/account/delete/' . $account->getId(),
                Translation::get('table_row_delete'),
                'fas fa-trash-alt',
                'btn-danger',
                Translation::get('admin_delete_account_warning_message'),
                $this->user->getId() === $account->getId()
            );
            $actions .= '</div>';

            $this->dataTable->addRow(
                ucfirst($account->getName()) . $blockState->toReadable(),
                lcfirst($account->getEmail()),
                $rights->toReadable(),
                $actions
            );
        }

        return $this->dataTable->get();
    }
}
