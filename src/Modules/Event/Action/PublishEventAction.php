<?php

namespace Modules\Event\Action;

use Components\Translation\TranslationOld;
use System\StateInterface;

/**
 * Provides an action for publishing events.
 *
 * @package Modules\Event\Action
 */
final class PublishEventAction extends EventActionBase {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->entity->setPublished(TRUE)->save();

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
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
