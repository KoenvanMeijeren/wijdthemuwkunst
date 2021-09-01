<?php

declare(strict_types=1);

namespace Modules\User\Actions;

use Components\Translation\TranslationOld;
use Modules\User\Entity\AccountInterface;
use System\StateInterface;

/**
 * Provides an action for updating account entities.
 *
 * @package Modules\User\Actions
 */
final class UpdateAccountDataAction extends AccountActionBase {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setName($this->request()->post('name'));
    $this->entity->setRights((int) $this->request()->post('rights'));

    return parent::handle();
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    if ($this->request()->post('rights') !== $this->currentUser()->getRights()
      && $this->entity->id() === $this->currentUser()->getId()) {
      $this->session()->flash(
        StateInterface::FAILED,
        TranslationOld::get('cannot_edit_own_account_rights_message')
      );

      return FALSE;
    }

    return parent::authorize();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $this->validator->input('name', TranslationOld::get('name'))
      ->isRequired();

    $this->validator->input('rights', TranslationOld::get('rights'))
      ->isRequired()
      ->isBetweenRange(AccountInterface::ADMIN, AccountInterface::DEVELOPER);

    return $this->validator->handleFormValidation();
  }

}
