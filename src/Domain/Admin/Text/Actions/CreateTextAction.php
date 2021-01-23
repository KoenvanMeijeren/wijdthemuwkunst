<?php

namespace Domain\Admin\Text\Actions;

use Domain\Admin\Text\Entity\Text;
use Components\Translation\TranslationOld;

/**
 * Provides a class for the create text action.
 *
 * @package Domain\Admin\Text\Actions
 */
final class CreateTextAction extends BaseTextAction {

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
  protected function validate(): bool {
    $entities = $this->storage->loadByAttributes(['translation_key' => $this->request()->post('key')]);
    $message = sprintf(TranslationOld::get('text_already_exists'), $this->request()->post('key'));
    $this->validator->input('key')->isUnique($entities, $message);

    return parent::validate();
  }

}
