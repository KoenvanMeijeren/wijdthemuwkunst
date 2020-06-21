<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Actions;

use Src\State\State;
use Src\Translation\Translation;

/**
 *
 */
final class DeleteAccountAction extends BaseAccountAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->account->delete($this->account->getId());

    if ($this->account->find($this->account->getId()) !== NULL) {
      $this->session->flash(
            State::FAILED,
            Translation::get('admin_deleted_account_failed_message')
        );

      return FALSE;
    }

    $this->session->flash(
          State::SUCCESSFUL,
          Translation::get('admin_deleted_account_successful_message')
      );

    return TRUE;
  }

  /**
   * @inheritDoc
   */
  protected function authorize(): bool {
    if ($this->user->getId() === $this->account->getId()) {
      $this->session->flash(
            State::FAILED,
            Translation::get('cannot_delete_own_account_message')
        );
      return FALSE;
    }

    return parent::authorize();
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    return TRUE;
  }

}
