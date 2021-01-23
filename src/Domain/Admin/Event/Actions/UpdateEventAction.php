<?php

namespace Domain\Admin\Event\Actions;

use Components\Translation\TranslationOld;
use System\StateInterface;

/**
 *
 */
final class UpdateEventAction extends BaseEventAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->event->update($this->event->getId(), $this->attributes);

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              TranslationOld::get('event_successfully_updated'),
              $this->eventRepository->getTitle()
          )
      );

    return TRUE;
  }

}
