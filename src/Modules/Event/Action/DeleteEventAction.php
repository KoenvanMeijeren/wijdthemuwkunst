<?php

namespace Modules\Event\Action;

use Components\Translation\TranslationOld;
use System\State;

/**
 * Provides an action for deleting events.
 *
 * @package Modules\Event\Action
 */
class DeleteEventAction extends EventActionBase {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $slug = $this->entity->getTitle();
    $this->entity->delete();

    if ($this->entityManager->getStorage($this->getEntityType())->load($this->entity->id()) !== NULL) {
      $this->session()->flash(
        State::FAILED->value,
        sprintf(TranslationOld::get('event_unsuccessfully_deleted'), $slug)
      );

      return FALSE;
    }

    $this->session()->flash(
      State::SUCCESSFUL->value,
      sprintf(TranslationOld::get('event_successfully_deleted'), $slug)
    );

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    return TRUE;
  }

}
