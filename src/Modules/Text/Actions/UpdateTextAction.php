<?php

namespace Modules\Text\Actions;

use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use Modules\User\Entity\AccountInterface;
use System\State;

/**
 * Provides a class for the update text action.
 *
 * @package Domain\Admin\Text\Actions
 */
final class UpdateTextAction extends BaseTextAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setKey($this->request()->post('key'));
    $this->entity->setValue($this->request()->post('value'));

    return $this->saveEntity();
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    if ($this->user()->getRouteRights()->hasAccessForbidden(RouteRights::DEVELOPER)
      && $this->request()->post('key') !== $this->entity->getKey()) {
      $this->session()->flash(State::FAILED->value, TranslationOld::get('text_editing_key_not_allowed'));

      return FALSE;
    }

    return parent::authorize();
  }

}
