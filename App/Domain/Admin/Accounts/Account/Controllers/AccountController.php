<?php
declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Controllers;

use Domain\Admin\Accounts\Account\Actions\BlockAccountAction;
use Domain\Admin\Accounts\Account\Actions\CreateAccountAction;
use Domain\Admin\Accounts\Account\Actions\DeleteAccountAction;
use Domain\Admin\Accounts\Account\Actions\UnblockAccountAction;
use Domain\Admin\Accounts\Account\Actions\UpdateAccountDataAction;
use Domain\Admin\Accounts\Account\Actions\UpdateAccountEmailAction;
use Domain\Admin\Accounts\Account\Actions\UpdateAccountPasswordAction;
use Domain\Admin\Accounts\Account\Models\Account;
use Domain\Admin\Accounts\Account\ViewModels\EditViewModel;
use Domain\Admin\Accounts\Account\ViewModels\IndexViewModel;
use Src\Exceptions\Basic\InvalidKeyException;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\DomainView;

final class AccountController
{
    private Account $account;

    private string $baseViewPath = 'Admin/Accounts/Account/Views/';

    public function __construct()
    {
        $this->account = new Account();
    }

    public function index(): DomainView
    {
        $accounts = new IndexViewModel($this->account->all());

        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('admin_account_title'),
                'accounts' => $accounts->table()
            ]
        );
    }

    public function create(): DomainView
    {
        return new DomainView(
            $this->baseViewPath . 'create',
            [
                'title' => Translation::get('admin_create_account_title')
            ]
        );
    }

    /**
     * @return Redirect|DomainView
     */
    public function store()
    {
        $create = new CreateAccountAction($this->account);
        if ($create->execute()) {
            return new Redirect('/admin/account');
        }

        return $this->create();
    }

    /**
     * @param string $title
     *
     * @return Redirect|DomainView
     * @throws InvalidKeyException
     */
    public function edit(string $title = 'admin_edit_account_title')
    {
        $account = new EditViewModel(
            $this->account->find($this->account->getId())
        );

        return new DomainView(
            $this->baseViewPath . 'edit',
            [
                'title' => Translation::get($title),
                'account' => $account->get()
            ]
        );
    }

    /**
     * @return Redirect|DomainView
     * @throws InvalidKeyException
     */
    public function storeData()
    {
        $account = new UpdateAccountDataAction($this->account);
        if ($account->execute()) {
            return new Redirect(
                '/admin/account/edit/' . $this->account->getId()
            );
        }

        return $this->edit('admin_create_account_title');
    }

    /**
     * @return Redirect|DomainView
     * @throws InvalidKeyException
     */
    public function storeEmail()
    {
        $account = new UpdateAccountEmailAction($this->account);
        if ($account->execute()) {
            return new Redirect(
                '/admin/account/edit/' . $this->account->getId()
            );
        }

        return $this->edit('admin_edit_account_title');
    }

    /**
     * @return Redirect|DomainView
     * @throws InvalidKeyException
     */
    public function storePassword()
    {
        $account = new UpdateAccountPasswordAction($this->account);
        if ($account->execute()) {
            return new Redirect(
                '/admin/account/edit/' . $this->account->getId()
            );
        }

        return $this->edit('admin_edit_account_title');
    }

    public function block(): Redirect
    {
        $block = new BlockAccountAction($this->account);
        $block->execute();

        return new Redirect(
            '/admin/account/edit/' . $this->account->getId()
        );
    }

    public function unblock(): Redirect
    {
        $unblock = new UnblockAccountAction($this->account);
        $unblock->execute();

        return new Redirect(
            '/admin/account/edit/' . $this->account->getId()
        );
    }

    public function destroy(): Redirect
    {
        $delete = new DeleteAccountAction($this->account);
        $delete->execute();

        return new Redirect('/admin/account');
    }
}
