<?php

namespace App\Domain\Admin\Event\Actions;

use Src\State\State;
use Src\Translation\Translation;

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

    $this->session->flash(
          State::SUCCESSFUL,
          sprintf(
              Translation::get('event_successfully_activated'),
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
