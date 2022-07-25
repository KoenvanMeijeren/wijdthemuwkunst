<?php

declare(strict_types=1);

namespace Modules\User\Actions;

use Components\Translation\TranslationOld;
use System\State;

/**
 * Provides an action for blocking account entities.
 *
 * @package Modules\User\Actions
 */
final class BlockAccountAction extends AccountActionBase {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setBlocked()->save();

    $this->session()->flash(
      State::SUCCESSFUL->value,
      TranslationOld::get('admin_account_successful_blocked_message')
    );

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    if ($this->currentUser()->id() === $this->entity->id()) {
      $this->session()->flash(
        State::FAILED->value,
        TranslationOld::get('cannot_block_own_account_message')
      );

      return FALSE;
    }

    return parent::authorize();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    return TRUE;
  }

}
