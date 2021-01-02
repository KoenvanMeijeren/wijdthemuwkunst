<?php

namespace Domain\Admin\ContactForm\Actions;

/**
 *
 */
final class SaveContactFormMessageAction extends BaseContactFormAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->contactForm->create($this->attributes);

    return TRUE;
  }

  /**
   *
   */
  protected function authorize(): bool {
    return TRUE;
  }

}
