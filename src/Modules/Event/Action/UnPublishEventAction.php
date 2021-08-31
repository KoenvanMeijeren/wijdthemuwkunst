<?php

namespace Modules\Event\Action;

use Components\Translation\TranslationOld;
use System\StateInterface;

/**
 * Provides an action for creating events.
 *
 * @package Modules\Event\Action
 */
final class UnPublishEventAction extends EventActionBase {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setPublished(FALSE)->save();

    $this->session()->flash(
      StateInterface::SUCCESSFUL,
      sprintf(
        TranslationOld::get('event_successfully_unpublished'),
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
