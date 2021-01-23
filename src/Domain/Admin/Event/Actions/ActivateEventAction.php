<?php

namespace Domain\Admin\Event\Actions;

use Components\Translation\TranslationOld;
use System\StateInterface;

/**
 *
 */
class ActivateEventAction extends BaseEventAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->event->update($this->eventRepository->getId(), [
      'event_is_archived' => '0',
    ]);

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              TranslationOld::get('event_successfully_activated'),
              $this->eventRepository->getTitle()
          )
      );

    return TRUE;
  }

  /**
   *
   */
  protected function validate(): bool {
    return TRUE;
  }

}
