<?php

declare(strict_types=1);


namespace Modules\User\Actions;

use Components\Translation\TranslationOld;
use Domain\Admin\Authentication\Support\IDEncryption;
use System\StateInterface;

/**
 * Provides an action for updating account entities.
 *
 * @package Modules\User\Actions
 */
final class UpdateUserPasswordAction extends AccountActionBase {

  /**
   * {@inheritDoc}
   */
  public function __construct() {
    parent::__construct();

    if ($id = $this->getUserId()) {
      $this->entity = $this->storage->load($id);
    }
  }

  /**
   * Get the id of the user.
   *
   * It does not matter if the user is logged in.
   * If the user is logged in, the id of the user will be returned.
   * Otherwise, the guest id is returned.
   *
   * @return int the id of the user
   */
  protected function getUserId(): int {
    $idEncryption = new IDEncryption();

    return $idEncryption->decrypt($this->session()->get('userID'));
  }

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setPassword($this->request()->post('currentPassword'));
    $this->entity->save();

    $this->session()->flash(
      StateInterface::SUCCESSFUL,
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
