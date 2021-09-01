<?php

declare(strict_types=1);

namespace Modules\User\Actions;

use Components\Translation\TranslationOld;
use Domain\Admin\Authentication\Support\IDEncryption;

/**
 * Provides an action for updating account entities.
 *
 * @package Modules\User\Actions
 */
final class UpdateUserDataAction extends AccountActionBase {

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
    $this->entity->setName($this->request()->post('name'));

    return parent::handle();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input('name', TranslationOld::get('name'))->isRequired();

    return $this->validator->handleFormValidation();
  }

}
