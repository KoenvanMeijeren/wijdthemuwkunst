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
    private User $user;

    private string $baseViewPath = 'Admin/Accounts/User/Views/';

    public function __construct()
    {
        $this->user = new User();
    }

    public function index(): DomainView
    {
        return new DomainView(
            $this->baseViewPath . 'index',
            [
                'title' => Translation::get('admin_account_title'),
                'account' => $this->user->getAccount()
            ]
        );
    }

    /**
     * @return Redirect|DomainView
     */
    public function storeData()
    {
        $updateUser = new UpdateUserDataAction($this->user);
        if ($updateUser->execute()) {
            return new Redirect('/admin/user/account');
        }

        return $this->index();
    }

    /**
     * @return Redirect|DomainView
     */
    public function storePassword()
    {
        $updateUser = new UpdateUserPasswordAction($this->user);
        if ($updateUser->execute()) {
            return new Redirect('/admin/user/account');
        }

        return $this->index();
    }
}
