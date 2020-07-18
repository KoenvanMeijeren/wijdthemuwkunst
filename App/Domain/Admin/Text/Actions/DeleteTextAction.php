<?php

namespace Domain\Admin\Text\Actions;

use Domain\Admin\Accounts\User\Models\User;
use Src\Core\StateInterface;
use Src\Translation\Translation;
use System\Entity\EntityInterface;

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
      $this->session->flash(
        StateInterface::SUCCESSFUL,
        sprintf(Translation::get('text_successful_deleted'), $this->entity->getKey())
      );

      return TRUE;
    }

    $this->session->flash(
      StateInterface::SUCCESSFUL,
      sprintf(Translation::get('text_unsuccessful_deleted'), $this->entity->getKey())
    );

    return FALSE;
  }

  /**
   * @inheritDoc
   */
  protected function authorize(): bool {
    if ($this->user->getRights() !== User::DEVELOPER) {
      $this->session->flash(StateInterface::FAILED, Translation::get('text_destroy_not_allowed'));

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
