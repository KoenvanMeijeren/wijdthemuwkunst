<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Actions;

use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\Account\Models\Account;
use Domain\Admin\Accounts\User\Models\User;
use System\StateInterface;

/**
 *
 */
final class CreateAccountAction extends BaseAccountAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $account = $this->account->firstOrCreate([
      'account_name' => $this->name,
      'account_email' => $this->email,
      'account_password' => (string) password_hash(
              $this->password,
              Account::PASSWORD_HASH_METHOD
      ),
      'account_rights' => (string) $this->rights,
    ]);

    if ($account === NULL) {
      $this->session()->flash(
            StateInterface::FAILED,
            TranslationOld::get('admin_create_account_unsuccessful_message')
        );

      return FALSE;
    }

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          TranslationOld::get('admin_create_account_successful_message')
      );

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input($this->name, TranslationOld::get('name'))
      ->isRequired();

    $this->validator->input($this->email, TranslationOld::get('email'))
      ->isRequired()
      ->isEmail()
      ->isUnique(
              $this->account->getByEmail($this->email),
              sprintf(
                  TranslationOld::get('admin_email_already_exists_message'),
                  $this->email
              )
          );

    $this->validator->input($this->password, TranslationOld::get('password'))
      ->isRequired()
      ->passwordIsEqual($this->confirmationPassword);

    $this->validator->input((string) $this->rights, TranslationOld::get('rights'))
      ->isRequired()
      ->isBetweenRange(
              User::ADMIN,
              User::DEVELOPER,
              TranslationOld::get('admin_invalid_rights_message')
          );

    return $this->validator->handleFormValidation();
  }

}
