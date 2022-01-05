<?php
declare(strict_types=1);

namespace Modules\User\Actions;

use Components\Translation\TranslationOld;
use Modules\User\CurrentUser;
use System\Entity\EntityInterface;
use System\State;

/**
 * Provides an action for updating account entities.
 *
 * @package Modules\User\Actions
 */
final class UpdateUserPasswordAction extends AccountActionBase {

  /**
   * {@inheritDoc}
   */
  protected function getEntity(): ?EntityInterface {
    return (new CurrentUser())->get();
  }

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setPassword($this->request()->post('currentPassword'));
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
    $this->validator->input('currentPassword')
      ->passwordIsVerified($this->entity->getPassword());

    $this->validator->input('newPassword')
      ->isRequired()
      ->passwordIsEqual($this->request()->post('confirmationPassword'))
      ->passwordIsNotCurrentPassword($this->entity->getPassword());

    return $this->validator->handleFormValidation();
  }

}
