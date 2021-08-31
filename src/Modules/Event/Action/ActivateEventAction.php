<?php

namespace Modules\Event\Action;

use Components\Translation\TranslationOld;
use System\StateInterface;

/**
 * Provides an action for activating events.
 *
 * @package Modules\Event\Action
 */
class ActivateEventAction extends EventActionBase {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setArchived(FALSE);
    $this->entity->save();

    $this->session()->flash(
      StateInterface::SUCCESSFUL,
      sprintf(
        TranslationOld::get('event_successfully_activated'),
        $this->entity->getTitle()
      )
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
