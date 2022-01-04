<?php

namespace Modules\Event\Action;

use Components\Translation\TranslationOld;
use System\State;

/**
 * Provides an action for publishing events.
 *
 * @package Modules\Event\Action
 */
final class PublishEventAction extends EventActionBase {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setPublished(TRUE)->save();

    $this->session()->flash(
          State::SUCCESSFUL->value,
          sprintf(
              TranslationOld::get('event_successfully_published'),
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
