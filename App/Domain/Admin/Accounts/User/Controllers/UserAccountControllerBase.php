<?php
declare(strict_types=1);


namespace Domain\Admin\Accounts\User\Controllers;

use App\System\Controller\AdminControllerBase;
use Domain\Admin\Accounts\User\Actions\UpdateUserDataAction;
use Domain\Admin\Accounts\User\Actions\UpdateUserPasswordAction;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\DomainView;

final class UserAccountControllerBase extends AdminControllerBase
{
    protected string $baseViewPath = 'Admin/Accounts/User/Views/';
    private string $redirectBack = '/admin/user/account';

    public function index(): DomainView
    {
        return $this->view('index', [
            'title' => Translation::get('admin_account_maintenance_title'),
            'account' => $this->user->getAccount()
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
