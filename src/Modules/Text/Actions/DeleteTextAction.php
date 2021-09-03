<?php

namespace Modules\Text\Actions;

use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\User\Models\User;
use System\Entity\EntityInterface;
use System\StateInterface;

/**
 * Provides a class for the delete text action.
 *
 * @package Domain\Admin\Text\Actions
 */
final class DeleteTextAction extends BaseTextAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $status = $this->entity->delete();
    if ($status === EntityInterface::SAVED_DELETED) {
      $this->session()->flash(StateInterface::SUCCESSFUL,
        sprintf(TranslationOld::get('text_successful_deleted'), $this->entity->getKey())
      );

      return TRUE;
    }

    $this->session()->flash(StateInterface::SUCCESSFUL,
      sprintf(TranslationOld::get('text_unsuccessful_deleted'), $this->entity->getKey())
    );

    return FALSE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    if ($this->currentUser()->getRights() !== User::DEVELOPER) {
      $this->session()->flash(StateInterface::FAILED, TranslationOld::get('text_destroy_not_allowed'));

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
