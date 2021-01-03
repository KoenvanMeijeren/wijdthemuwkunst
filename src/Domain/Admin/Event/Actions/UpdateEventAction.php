<?php

namespace Domain\Admin\Event\Actions;

use System\StateInterface;
use Src\Translation\Translation;

/**
 *
 */
final class UpdateEventAction extends BaseEventAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->event->update($this->event->getId(), $this->attributes);

    $this->session->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              Translation::get('event_successfully_updated'),
              $this->eventRepository->getTitle()
          )
      );

    return TRUE;
  }

}
