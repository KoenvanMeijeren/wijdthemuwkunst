<?php

namespace App\Domain\Admin\Event\Actions;

use Src\State\State;
use Src\Translation\Translation;

/**
 *
 */
final class RemoveEventThumbnailAction extends BaseEventAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->event->update($this->eventRepository->getId(), [
      'event_thumbnail_ID' => '0',
    ]);

    $this->session->flash(
          State::SUCCESSFUL,
          sprintf(
              Translation::get('event_thumbnail_successfully_removed'),
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
