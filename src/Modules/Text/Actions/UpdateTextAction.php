<?php

namespace Modules\Text\Actions;

use Components\Translation\TranslationOld;
use Modules\User\Entity\AccountInterface;
use System\StateInterface;

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
    if ($this->user()->getRights() !== AccountInterface::DEVELOPER
      && $this->request()->post('key') !== $this->entity->getKey()) {
      $this->session()->flash(StateInterface::FAILED, TranslationOld::get('text_editing_key_not_allowed'));

      return FALSE;
    }

    return parent::authorize();
  }

}
