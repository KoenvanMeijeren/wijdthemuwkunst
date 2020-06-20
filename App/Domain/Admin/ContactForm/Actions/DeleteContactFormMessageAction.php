<?php

namespace App\Domain\Admin\ContactForm\Actions;

use Src\State\State;
use Src\Translation\Translation;

/**
 *
 */
final class DeleteContactFormMessageAction extends BaseContactFormAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->contactForm->delete($this->contactForm->getId());

    $this->session->flash(
          State::SUCCESSFUL,
          sprintf(
              Translation::get('admin_delete_contact_form_message'),
              $this->repository->getName()
          )
      );

    return TRUE;
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    return TRUE;
  }

}
