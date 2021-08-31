<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\User\Actions;

use Components\Translation\TranslationOld;

/**
 *
 */
final class UpdateUserDataAction extends BaseUserAction {

  /**
   * {@inheritDoc}
   */
  protected function prepareAttributes(): void {
    $this->attributes = [
      'account_name' => $this->name,
    ];
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input($this->name, TranslationOld::get('name'))->isRequired();

    return $this->validator->handleFormValidation();
  }

}
