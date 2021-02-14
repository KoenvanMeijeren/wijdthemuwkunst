<?php

namespace Modules\ContactForm\Actions;

use Components\Translation\TranslationOld;
use System\StateInterface;

/**
 * Provides a way to delete contact form messages.
 *
 * @package Domain\Admin\ContactForm\Actions
 */
final class DeleteContactFormMessageAction extends BaseContactFormAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->contactForm->delete($this->contactForm->getId());

    $this->session()->flash(StateInterface::SUCCESSFUL, sprintf(
      TranslationOld::get('admin_delete_contact_form_message'),
      $this->repository->getName()
    ));

    return TRUE;
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    return TRUE;
  }

}
