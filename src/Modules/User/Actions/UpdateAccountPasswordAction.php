<?php

declare(strict_types=1);

namespace Modules\User\Actions;

use Components\Translation\TranslationOld;

/**
 * Provides an action for updating account entities.
 *
 * @package Modules\User\Actions
 */
final class UpdateAccountPasswordAction extends AccountActionBase {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setPassword($this->request()->post('password'));

    return parent::handle();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input('password', TranslationOld::get('password'))
      ->isRequired()
      ->passwordIsEqual($this->request()->post('confirmationPassword'));

    return $this->validator->handleFormValidation();
  }

}
