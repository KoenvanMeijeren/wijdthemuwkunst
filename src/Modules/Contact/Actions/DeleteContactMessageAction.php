<?php

namespace Modules\Contact\Actions;

use Components\Translation\TranslationOld;
use System\Entity\Status\EntitySaveStatus;
use System\State;

/**
 * Provides a way to delete contact form messages.
 *
 * @package Domain\Admin\Contact\Actions
 */
final class DeleteContactMessageAction extends BaseContactAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $status = $this->entity->delete();
    if ($status === EntitySaveStatus::SAVED_DELETED) {
      $this->session()->flash(State::SUCCESSFUL->value,
        sprintf(TranslationOld::get('admin_delete_contact_form_message'), $this->entity->getName())
      );

      return TRUE;
    }

    $this->session()->flash(State::SUCCESSFUL->value,
      sprintf(TranslationOld::get('text_unsuccessful_deleted'), $this->entity->getName())
    );

    return FALSE;
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    return TRUE;
  }

}
