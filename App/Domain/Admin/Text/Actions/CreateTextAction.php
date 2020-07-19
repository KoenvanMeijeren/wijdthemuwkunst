<?php

namespace Domain\Admin\Text\Actions;

use Domain\Admin\Text\Entity\Text;
use Src\Translation\Translation;

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
    /** @var \Domain\Admin\Text\Entity\TextInterface $entity */
    $entity = $this->entity;

    $entity->setKey($this->request->post('key'));
    $entity->setValue($this->request->post('value'));

    return $this->saveEntity();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    $storage = $this->entityManager->getStorage(Text::class);
    $this->validator->input('key')->isUnique(
      $storage->loadByAttributes(['translation_key' => $this->request->post('key')]),
      sprintf(Translation::get('text_already_exists'), $this->request->post('key'))
    );

    return parent::validate();
  }

}
