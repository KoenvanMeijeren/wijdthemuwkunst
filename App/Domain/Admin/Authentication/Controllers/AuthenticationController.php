<?php
declare(strict_types=1);


namespace Domain\Admin\Authentication\Controllers;

use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Authentication\Actions\LogUserInAction;
use Domain\Admin\Authentication\Actions\LogUserOutAction;
use Src\Exceptions\Basic\InvalidKeyException;
use Src\Response\Redirect;
use Src\Translation\Translation;
use Src\View\DomainView;

final class AuthenticationController
{
    private User $user;

    private string $redirectTo = '/admin/dashboard';
    private string $redirectBack = '/admin';
    private string $baseViewPath = 'Admin/Authentication/Views/';

    public function __construct()
    {
        $this->user = new User();
    }

    /**
     * Load the login page.
     * If the user is already logged in redirect him to the dashboard.
     *
     * @return Redirect|DomainView
     * @throws InvalidKeyException
     */
    public function index()
    {
        if ($this->user->isLoggedIn()) {
            return new Redirect($this->redirectTo);
        }

        return new DomainView(
            $this->baseViewPath . 'login',
            [
                'title' => Translation::get('login_page_title')
            ]
        );
    }

    public function login(): Redirect
    {
        $login = new LogUserInAction($this->user);
        if ($login->execute()) {
            return new Redirect($this->redirectTo);
        }

        return new Redirect($this->redirectBack);
    }

    public function logout(): Redirect
    {
        $logout = new LogUserOutAction($this->user);
        $logout->execute();

        return new Redirect($this->redirectBack);
    }
}
