<?php

namespace Modules\Event\Action;

use Components\Translation\TranslationOld;
use System\StateInterface;

/**
 * Provides an action for removing thumbnails from events.
 *
 * @package Modules\Event\Action
 */
final class RemoveEventThumbnailAction extends EventActionBase {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setThumbnail(NULL)->save();

    $this->session()->flash(
      StateInterface::SUCCESSFUL,
      sprintf(
        TranslationOld::get('event_thumbnail_successfully_removed'),
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
