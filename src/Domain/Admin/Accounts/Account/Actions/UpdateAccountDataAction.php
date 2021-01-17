<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Actions;

use Domain\Admin\Accounts\User\Models\User;
use Src\Translation\Translation;
use System\StateInterface;

/**
 *
 */
final class UpdateAccountDataAction extends BaseAccountAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->account->update($this->account->getId(), [
      'account_name' => $this->name,
      'account_rights' => (string) $this->rights,
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
  protected function authorize(): bool {
    if ($this->rights !== $this->user->getRights()
          && $this->account->getId() === $this->user->getId()
      ) {
      $this->session()->flash(
            StateInterface::FAILED,
            Translation::get('cannot_edit_own_account_rights_message')
        );

      return FALSE;
    }

    return parent::authorize();
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    $this->validator->input($this->name, Translation::get('name'))
      ->isRequired();

    $this->validator->input((string) $this->rights, Translation::get('rights'))
      ->isRequired()
      ->isBetweenRange(User::ADMIN, User::DEVELOPER);

    return $this->validator->handleFormValidation();
  }

}