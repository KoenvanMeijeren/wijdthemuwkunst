<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Actions;

use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\Account\Models\Account;
use System\StateInterface;

/**
 *
 */
final class UpdateAccountPasswordAction extends BaseAccountAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->account->update($this->account->getId(), [
      'account_password' => (string) password_hash(
        $this->password, Account::PASSWORD_HASH_METHOD
      ),
    ]);

    $this->session()->flash(
      StateInterface::SUCCESSFUL,
      TranslationOld::get('admin_edited_account_successful_message')
    );

    return TRUE;
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    $this->validator->input($this->password, TranslationOld::get('password'))
      ->isRequired()
      ->passwordIsEqual($this->confirmationPassword)
      ->passwordIsNotCurrentPassword($this->accountRepository->getPassword());

    return $this->validator->handleFormValidation();
  }

}
