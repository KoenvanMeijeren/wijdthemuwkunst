<?php

namespace Domain\Admin\Event\Actions;

use Src\Core\StateInterface;
use Src\Translation\Translation;

/**
 *
 */
final class DeleteEventAction extends BaseEventAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->event->delete($this->event->getId());

    if ($this->event->find($this->event->getId()) !== NULL) {
      $this->session->flash(
            StateInterface::FAILED,
            sprintf(
                Translation::get('event_unsuccessfully_deleted'),
                $this->eventRepository->getTitle()
            )
        );

      return FALSE;
    }

    $this->session->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              Translation::get('event_successfully_deleted'),
              $this->eventRepository->getTitle()
          )
      );

    return TRUE;
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    return TRUE;
  }

}
