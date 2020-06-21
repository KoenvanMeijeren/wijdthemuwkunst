<?php

namespace Domain\Admin\Text\Actions;

use Domain\Admin\Accounts\User\Models\User;
use Src\State\State;
use Src\Translation\Translation;

/**
 *
 */
final class DeleteTextAction extends BaseTextAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->text->delete($this->text->getId());

    if ($this->text->find($this->text->getId()) === NULL) {
      $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('text_successful_deleted'),
                $this->textRepository->getKey()
            )
        );

      return TRUE;
    }

    $this->session->flash(
          State::SUCCESSFUL,
          sprintf(
              Translation::get('text_unsuccessful_deleted'),
              $this->textRepository->getKey()
          )
      );

    return FALSE;
  }

  /**
   * @inheritDoc
   */
  protected function authorize(): bool {
    $user = new User();
    if ($user->getRights() !== User::DEVELOPER) {
      $this->session->flash(
            State::FAILED,
            Translation::get('text_destroy_not_allowed')
        );

      return FALSE;
    }

    return parent::authorize();
  }

  /**
   *
   */
  protected function validate(): bool {
    return TRUE;
  }

}
