<?php
declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Controllers;

use App\System\Controller\AdminControllerBase;
use Domain\Admin\Accounts\Account\Actions\BlockAccountAction;
use Domain\Admin\Accounts\Account\Actions\CreateAccountAction;
use Domain\Admin\Accounts\Account\Actions\DeleteAccountAction;
use Domain\Admin\Accounts\Account\Actions\UnblockAccountAction;
use Domain\Admin\Accounts\Account\Actions\UpdateAccountDataAction;
use Domain\Admin\Accounts\Account\Actions\UpdateAccountEmailAction;
use Domain\Admin\Accounts\Account\Actions\UpdateAccountPasswordAction;
use Domain\Admin\Accounts\Account\Models\Account;
use Domain\Admin\Accounts\Account\ViewModels\AccountTable;
use Domain\Admin\Accounts\Account\ViewModels\EditViewModel;
use Src\Exceptions\Basic\InvalidKeyException;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\DomainView;

final class AccountController extends AdminControllerBase
{
    protected string $baseViewPath = 'Admin/Accounts/Account/Views/';

    private Account $account;
    private string $redirectBack = '/admin/account';

    public function __construct()
    {
        parent::__construct();

        $this->account = new Account();
    }

    public function index(): DomainView
    {
        $accountTable = new AccountTable($this->account->all());

        return $this->view('index', [
            'title' => Translation::get('admin_account_title'),
            'accounts' => $accountTable->get()
        ]);
    }

    public function create(): DomainView
    {
        return $this->view('create', [
            'title' => Translation::get('admin_create_account_title')
        ]);
    }

    /**
     * @return Redirect|DomainView
     */
    public function store()
    {
        $create = new CreateAccountAction();
        if ($create->execute()) {
            return new Redirect($this->redirectBack);
        }

        return $this->create();
    }

    /**
     * @return Redirect|DomainView
     * @throws InvalidKeyException
     */
    public function edit()
    {
        $account = new Account();
        $accountViewModel = new EditViewModel(
            $account->find($account->getId())
        );

        return $this->view('edit', [
            'title' => Translation::get('admin_edit_account_title'),
            'account' => $accountViewModel->get()
        ]);
    }

    /**
     * @return Redirect|DomainView
     * @throws InvalidKeyException
     */
    public function storeData()
    {
        $account = new UpdateAccountDataAction();
        if ($account->execute()) {
            return new Redirect(
                '/admin/account/edit/' . $this->account->getId()
            );
        }

        return $this->edit();
    }

    /**
     * @return Redirect|DomainView
     * @throws InvalidKeyException
     */
    public function storeEmail()
    {
        $account = new UpdateAccountEmailAction();
        if ($account->execute()) {
            return new Redirect(
                '/admin/account/edit/' . $this->account->getId()
            );
        }

        return $this->edit();
    }

    /**
     * @return Redirect|DomainView
     * @throws InvalidKeyException
     */
    public function storePassword()
    {
        $account = new UpdateAccountPasswordAction();
        if ($account->execute()) {
            return new Redirect(
                '/admin/account/edit/' . $this->account->getId()
            );
        }

        return $this->edit();
    }

    public function block(): Redirect
    {
        $block = new BlockAccountAction();
        $block->execute();

        return new Redirect(
            '/admin/account/edit/' . $this->account->getId()
        );
    }

    public function unblock(): Redirect
    {
        $unblock = new UnblockAccountAction();
        $unblock->execute();

        return new Redirect(
            '/admin/account/edit/' . $this->account->getId()
        );
    }

    public function destroy(): Redirect
    {
        $delete = new DeleteAccountAction();
        $delete->execute();

        return new Redirect($this->redirectBack);
    }
}
