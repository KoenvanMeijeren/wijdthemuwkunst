<?php
declare(strict_types=1);


namespace Domain\Admin\Accounts\User\Controllers;

use Domain\Admin\Accounts\User\Actions\UpdateUserDataAction;
use Domain\Admin\Accounts\User\Actions\UpdateUserPasswordAction;
use Domain\Admin\Accounts\User\Models\User;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\DomainView;

final class UserAccountController
{
    private string $baseViewPath = 'Admin/Accounts/User/Views/';
    private string $redirectBack = '/admin/user/account';

    public function index(): DomainView
    {
        $user = new User();

        return new DomainView($this->baseViewPath . 'index', [
            'title' => Translation::get('admin_account_title'),
            'account' => $user->getAccount()
        ]);
    }

    /**
     * @return Redirect|DomainView
     */
    public function storeData()
    {
        $updateUser = new UpdateUserDataAction();
        if ($updateUser->execute()) {
            return new Redirect($this->redirectBack);
        }

        return $this->index();
    }

    /**
     * @return Redirect|DomainView
     */
    public function storePassword()
    {
        $updateUser = new UpdateUserPasswordAction();
        if ($updateUser->execute()) {
            return new Redirect($this->redirectBack);
        }

        return $this->index();
    }
}
