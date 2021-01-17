<?php

namespace Domain\Admin\Event\Actions;

use Src\Translation\Translation;
use System\StateInterface;

/**
 *
 */
final class PublishEventAction extends BaseEventAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->event->update($this->eventRepository->getId(), [
      'event_is_published' => '1',
    ]);

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              Translation::get('event_successfully_published'),
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