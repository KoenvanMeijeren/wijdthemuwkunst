<?php

declare(strict_types=1);

namespace Modules\User\Actions;

use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use System\State;

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
    $input_rights = (int) $this->request()->post('rights');
    if (RouteRights::GUEST->hasAccessHigherNumeric($input_rights) && $input_rights !== $this->user()->getRights()
      && $this->entity->id() === $this->user()->id()) {
      $this->session()->flash(
        State::FAILED->value,
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
      ->isBetweenRange(RouteRights::ADMIN->value, RouteRights::DEVELOPER->value);

    return $this->validator->handleFormValidation();
  }

}
