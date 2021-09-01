<?php

namespace Modules\User\Actions;

use Components\Translation\TranslationOld;
use Modules\User\Entity\Account;

/**
 * Provides an action for creating account entities.
 *
 * @package Modules\User\Actions
 */
class CreateAccountAction extends AccountActionBase {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setName($this->request()->post('name'));
    $this->entity->setEmail($this->request()->post('email'));
    $this->entity->setPassword($this->request()->post('password'));
    $this->entity->setRights($this->request()->post('rights'));

    return parent::handle();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input('name', TranslationOld::get('name'))->isRequired();

    $entities = $this->storage->loadByAttributes(['account_email' => $this->request()->post('email')]);
    $message = sprintf(TranslationOld::get('admin_email_already_exists_message'), $this->request()->post('email'));
    $this->validator->input('email', TranslationOld::get('email'))
      ->isRequired()
      ->isEmail()
      ->isUnique($entities, $message);

    $this->validator->input('password', TranslationOld::get('password'))
      ->isRequired()
      ->passwordIsEqual($this->request()->post('confirmationPassword'));

    $this->validator->input('rights', TranslationOld::get('rights'))
      ->isRequired()
      ->isBetweenRange(
        Account::ADMIN,
        Account::DEVELOPER,
        TranslationOld::get('admin_invalid_rights_message')
      );

    return $this->validator->handleFormValidation();
  }


}
