<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Actions;

use Src\Translation\Translation;
use System\StateInterface;

/**
 *
 */
final class UpdateAccountEmailAction extends BaseAccountAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->account->update($this->account->getId(), [
      'account_email' => $this->email,
    ]);

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          Translation::get('admin_edited_account_successful_message')
      );

    return TRUE;
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    // Only validate if the email has been changed.
    if ($this->email === $this->accountRepository->getEmail()) {
      return TRUE;
    }

    $this->validator->input($this->email, Translation::get('email'))
      ->isEmail()
      ->isUnique(
              $this->account->getByEmail($this->email),
              sprintf(
                  Translation::get('admin_email_already_exists_message'),
                  $this->email
              )
          );

    return $this->validator->handleFormValidation();
  }

}
