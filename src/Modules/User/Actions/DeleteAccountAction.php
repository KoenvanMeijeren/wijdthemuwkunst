<?php

declare(strict_types=1);

namespace Modules\User\Actions;

use Components\Translation\TranslationOld;
use System\Entity\Status\EntitySaveStatus;
use System\State;

/**
 * Provides an action for deleting account entities.
 *
 * @package Modules\User\Actions
 */
final class DeleteAccountAction extends AccountActionBase {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $status = $this->entity->delete();
    if ($status === EntitySaveStatus::SAVED_DELETED) {
      $this->session()->flash(State::SUCCESSFUL->value,
        sprintf(TranslationOld::get('admin_deleted_account_successful_message'), $this->entity->getKey())
      );

      return TRUE;
    }

    $this->session()->flash(State::SUCCESSFUL->value,
      sprintf(TranslationOld::get('admin_deleted_account_failed_message'), $this->entity->getKey())
    );

    return FALSE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    if ($this->user()->id() === $this->entity->id()) {
      $this->session()->flash(
        State::FAILED->value,
        TranslationOld::get('cannot_delete_own_account_message')
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
