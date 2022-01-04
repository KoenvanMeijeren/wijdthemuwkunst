<?php

declare(strict_types=1);

namespace Modules\User\Actions;

use Components\Translation\TranslationOld;
use System\State;

/**
 * Provides an action for updating account entities.
 *
 * @package Modules\User\Actions
 */
final class UpdateAccountEmailAction extends AccountActionBase {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setEmail($this->request()->post('email'));
    $this->entity->save();

    $this->session()->flash(
      State::SUCCESSFUL->value,
      TranslationOld::get('admin_edited_account_successful_message')
    );

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    // Only validate if the email has been changed.
    if ($this->request()->post('email') === $this->entity->getEmail()) {
      return TRUE;
    }

    $entities = $this->storage->loadByAttributes(['email' => $this->request()->post('email')]);
    $message = sprintf(TranslationOld::get('admin_email_already_exists_message'), $this->request()->post('email'));
    $this->validator->input('email', TranslationOld::get('email'))
      ->isRequired()
      ->isEmail()
      ->isUnique($entities, $message);

    return $this->validator->handleFormValidation();
  }

}
