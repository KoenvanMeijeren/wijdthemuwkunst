<?php

declare(strict_types=1);

namespace Domain\Admin\Accounts\Account\Actions;

use Components\Actions\FormAction;
use Domain\Admin\Accounts\Account\Models\Account;
use Domain\Admin\Accounts\Repositories\AccountRepository;
use Domain\Admin\Accounts\User\Models\User;

/**
 *
 */
abstract class BaseAccountAction extends FormAction {

  protected User $user;
  protected Account $account;
  protected AccountRepository $accountRepository;

  protected string $name;
  protected string $email;
  protected string $password;
  protected string $confirmationPassword;
  protected int $rights;

  /**
   * {@inheritDoc}
   */
  public function __construct() {
    $this->user = new User();
    $this->account = new Account();
    $this->accountRepository = new AccountRepository(
          $this->account->find($this->account->getId())
      );

    $this->name = $this->request()->post('name', $this->accountRepository->getName());
    $this->email = $this->request()->post('email', $this->accountRepository->getEmail());
    $this->password = $this->request()->post('password');
    $this->confirmationPassword = $this->request()->post('confirmationPassword');
    $this->rights = (int) $this->request()->post('rights', $this->accountRepository->getRights());
  }

}
