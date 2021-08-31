<?php

declare(strict_types=1);


namespace Domain\Admin\Authentication\Actions;

use Components\Actions\FormAction;
use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\Account\Models\Account;
use Domain\Admin\Accounts\Repositories\AccountRepository;
use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Authentication\Support\IDEncryption;
use System\StateInterface;

/**
 *
 */
final class LogUserInAction extends FormAction {
  protected User $user;
  protected AccountRepository $account;

  protected string $email;
  protected string $password;

  protected int $maximumLoginAttempts;

  protected array $attributes = [];

  /**
   * LogUserInAction constructor.
   *
   * @param \Domain\Admin\Accounts\User\Models\User $user
   *   The user to be logged in.
   */
  public function __construct(User $user) {
    parent::__construct();

    $this->user = $user;

    $this->email = $this->request()->post('email');
    $this->password = $this->request()->post('password');
    $this->maximumLoginAttempts = (int) $this->request()->env('login_attempts');

    $this->account = new AccountRepository($this->user->getByEmail($this->email));
  }

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    if (password_verify($this->password, $this->account->getPassword())) {
      $this->session()->unset('userID');

      $idEncryption = new IDEncryption();
      $token = $idEncryption->generateToken();

      $this->session()->save('userID', $idEncryption->encrypt($this->account->getId(), $token));

      // Always executed.
      $this->storeToken($token);
      $this->rehashPassword();
      // Only executed when the user is an admin.
      $this->resetFailedLogInAttempts();

      $this->store();

      $this->session()->flash(StateInterface::SUCCESSFUL, TranslationOld::get('login_successful_message'));

      return TRUE;
    }

    // Only executed when the user is an admin.
    $this->addFailedLogInAttempt();
    $this->blockAccount();

    $this->store();

    $this->session()->flash(StateInterface::FAILED, TranslationOld::get('login_failed_message'));

    return FALSE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    if ($this->account->isBlocked()) {
      $this->session()->flash(StateInterface::FAILED, TranslationOld::get('login_failed_blocked_account_message'));

      return FALSE;
    }

    return parent::authorize();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input($this->email, TranslationOld::get('email'))
      ->isRequired()
      ->isEmail();

    $this->validator->input($this->password, TranslationOld::get('password'))
      ->isRequired();

    return $this->validator->handleFormValidation();
  }

  /**
   * {@inheritDoc}
   */
  private function storeToken(string $token): void {
    $this->attributes['account_login_token'] = $token;
  }

  /**
   * {@inheritDoc}
   */
  private function rehashPassword(): void {
    if (password_needs_rehash($this->account->getPassword(), Account::PASSWORD_HASH_METHOD)) {
      $this->attributes['account_password'] = (string) password_hash(
        $this->account->getPassword(), Account::PASSWORD_HASH_METHOD
      );
    }
  }

  /**
   * {@inheritDoc}
   */
  private function resetFailedLogInAttempts(): void {
    if ($this->account->getRights() > User::ADMIN) {
      return;
    }

    $this->attributes['account_failed_login'] = '0';
  }

  /**
   * {@inheritDoc}
   */
  private function addFailedLogInAttempt(): void {
    if ($this->account->getRights() > User::ADMIN) {
      return;
    }

    $current = $this->account->getFailedLogInAttempts();
    $this->attributes['account_failed_login'] = (string) ++$current;
  }

  /**
   * If the number of failed log in attempts is higher than
   * the maximum number of failed log in attempts, block the account.
   */
  private function blockAccount(): void {
    if ($this->account->getRights() > User::ADMIN
      || $this->account->getFailedLogInAttempts() < $this->maximumLoginAttempts
    ) {
      return;
    }

    $this->attributes['account_is_blocked'] = '1';
  }

  /**
   * {@inheritDoc}
   */
  private function store(): void {
    if (count($this->attributes) === 0) {
      return;
    }

    $this->user->update($this->account->getId(), $this->attributes);
  }

}
