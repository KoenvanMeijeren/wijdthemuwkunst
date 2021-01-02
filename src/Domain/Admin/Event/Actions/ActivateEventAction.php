<?php

namespace Domain\Admin\Event\Actions;

use Src\Core\StateInterface;
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
          StateInterface::SUCCESSFUL,
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
