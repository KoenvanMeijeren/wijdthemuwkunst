<?php

namespace Domain\Admin\Text\Actions;

use Domain\Admin\Accounts\User\Models\User;
use System\StateInterface;
use Src\Translation\Translation;

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
    /** @var \Domain\Admin\Text\Entity\TextInterface $entity */
    $entity = $this->entity;

    $entity->setKey($this->request->post('key'));
    $entity->setValue($this->request->post('value'));

    return $this->saveEntity();
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    /** @var \Domain\Admin\Text\Entity\TextInterface $entity */
    $entity = $this->entity;

    if ($this->user->getRights() !== User::DEVELOPER
      && $this->request->post('key') !== $entity->getKey()
    ) {
      $this->session->flash(StateInterface::FAILED,
        Translation::get('text_editing_key_not_allowed')
      );

      return FALSE;
    }

    return parent::authorize();
  }

}
