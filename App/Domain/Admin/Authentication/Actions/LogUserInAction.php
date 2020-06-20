<?php

declare(strict_types=1);


namespace Domain\Admin\Authentication\Actions;

use Domain\Admin\Accounts\Account\Models\Account;
use Domain\Admin\Accounts\Repositories\AccountRepository;
use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Authentication\Support\IDEncryption;
use Src\Action\FormAction;
use Src\Core\Request;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;
use Src\Validate\form\FormValidator;

/**
 *
 */
final class LogUserInAction extends FormAction {
  private User $user;
  private Session $session;
  private AccountRepository $account;

  private string $email;
  private string $password;

  private int $maximumLoginAttempts;

  private array $attributes = [];

  /**
   *
   */
  public function __construct(User $user) {
    $request = new Request();
    $this->session = new Session();

    $this->user = $user;

    $this->email = $request->post('email');
    $this->password = $request->post('password');

    $this->maximumLoginAttempts = (int) $request->env('login_attempts');

    $this->account = new AccountRepository(
          $this->user->getByEmail($this->email)
      );
  }

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    if (password_verify($this->password, $this->account->getPassword())) {
      $this->session->unset('userID');

      $idEncryption = new IDEncryption();
      $token = $idEncryption->generateToken();

      $this->session->save(
            'userID',
            $idEncryption->encrypt($this->account->getId(), $token)
        );

      // Always executed.
      $this->storeToken($token);
      $this->rehashPassword();
      // Only executed when the user is an admin.
      $this->resetFailedLogInAttempts();

      $this->store();

      $this->session->flash(
            State::SUCCESSFUL,
            Translation::get('login_successful_message')
        );

      return TRUE;
    }

    // Only executed when the user is an admin.
    $this->addFailedLogInAttempt();
    $this->blockAccount();

    $this->store();

    $this->session->flash(
          State::FAILED,
          Translation::get('login_failed_message')
      );

    return FALSE;
  }

  /**
   * @inheritDoc
   */
  protected function authorize(): bool {
    if ($this->account->isBlocked()) {
      $this->session->flash(
            State::FAILED,
            Translation::get('login_failed_blocked_account_message')
        );

      return FALSE;
    }

    return parent::authorize();
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    $validator = new FormValidator();

    $validator->input($this->email, Translation::get('email'))
      ->isRequired()
      ->isEmail();

    $validator->input($this->password, Translation::get('password'))
      ->isRequired();

    return $validator->handleFormValidation();
  }

  /**
   *
   */
  private function storeToken(string $token): void {
    $this->attributes['account_login_token'] = $token;
  }

  /**
   *
   */
  private function rehashPassword(): void {
    if (password_needs_rehash(
          $this->account->getPassword(),
          Account::PASSWORD_HASH_METHOD
      )
      ) {
      $this->attributes['account_password'] = (string) password_hash(
            $this->account->getPassword(),
            Account::PASSWORD_HASH_METHOD
        );
    }
  }

  /**
   *
   */
  private function resetFailedLogInAttempts(): void {
    if ($this->account->getRights() > User::ADMIN) {
      return;
    }

    $this->attributes['account_failed_login'] = '0';
  }

  /**
   *
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
          || $this->account->getFailedLogInAttempts() < $this->maximumLoginAttempts) {
      return;
    }

    $this->attributes['account_is_blocked'] = '1';
  }

  /**
   *
   */
  private function store(): void {
    if (sizeof($this->attributes) === 0) {
      return;
    }

    $this->user->update($this->account->getId(), $this->attributes);
  }

}
