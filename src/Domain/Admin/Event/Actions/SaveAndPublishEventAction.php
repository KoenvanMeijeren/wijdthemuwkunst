<?php

namespace Domain\Admin\Event\Actions;

use Src\Core\StateInterface;
use Src\Translation\Translation;

/**
 *
 */
final class SaveAndPublishEventAction extends BaseEventAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->attributes['event_is_published'] = '1';

    $this->event->updateOrCreate($this->event->getId(), $this->attributes);

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
