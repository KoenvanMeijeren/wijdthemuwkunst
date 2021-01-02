<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\User\Actions;

use Domain\Admin\Accounts\Account\Models\Account;

/**
 *
 */
final class UpdateUserPasswordAction extends BaseUserAction {

  /**
   * @inheritDoc
   */
  protected function prepareAttributes(): void {
    $this->attributes = [
      'account_password' => (string) password_hash(
              $this->newPassword,
              Account::PASSWORD_HASH_METHOD
      ),
    ];
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    $this->validator->input($this->currentPassword)
      ->passwordIsVerified($this->account->getPassword());

    $this->validator->input($this->newPassword)
      ->isRequired()
      ->passwordIsEqual($this->confirmationPassword)
      ->passwordIsNotCurrentPassword($this->currentPassword);

    return $this->validator->handleFormValidation();
  }

}
