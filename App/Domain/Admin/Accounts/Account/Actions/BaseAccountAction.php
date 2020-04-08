<?php


namespace App\Domain\Admin\Accounts\Account\Actions;


use Domain\Admin\Accounts\Account\Models\Account;
use Domain\Admin\Accounts\Repositories\AccountRepository;
use Domain\Admin\Accounts\User\Models\User;
use Src\Action\FormAction;
use Src\Core\Request;
use Src\Session\Session;
use Src\Validate\form\FormValidator;

abstract class BaseAccountAction extends FormAction
{
    protected User $user;
    protected Account $account;
    protected AccountRepository $accountRepository;
    protected Session $session;
    protected FormValidator $validator;

    protected string $name;
    protected string $email;
    protected string $password;
    protected string $confirmationPassword;
    protected int $rights;

    public function __construct()
    {
        $this->user = new User();
        $this->account = new Account();
        $this->accountRepository = new AccountRepository(
            $this->account->find($this->account->getId())
        );
        $this->session = new Session();
        $this->validator = new FormValidator();
        $request = new Request();

        $this->name = $request->post('name', $this->accountRepository->getName());
        $this->email = $request->post('email', $this->accountRepository->getEmail());
        $this->password = $request->post('password');
        $this->confirmationPassword = $request->post('confirmationPassword');
        $this->rights = (int)$request->post('rights', $this->accountRepository->getRights());
    }
}
