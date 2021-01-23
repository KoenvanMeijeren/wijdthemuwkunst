<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Actions;

use Components\Translation\TranslationOld;
use System\StateInterface;

/**
 *
 */
final class UnblockAccountAction extends BaseAccountAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->account->update($this->account->getId(), [
      'account_is_blocked' => '0',
    ]);

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          TranslationOld::get('admin_account_successful_unblocked_message')
      );

    return TRUE;
  }

  /**
   * @inheritDoc
   */
  protected function authorize(): bool {
    if ($this->user->getId() === $this->account->getId()) {
      $this->session()->flash(
            StateInterface::FAILED,
            TranslationOld::get('cannot_unblock_own_account_message')
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
