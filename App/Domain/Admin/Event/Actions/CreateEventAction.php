<?php

namespace Domain\Admin\Event\Actions;

use Src\Core\StateInterface;
use Src\Translation\Translation;

/**
 *
 */
final class CreateEventAction extends BaseEventAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $event = $this->event->firstOrCreate($this->attributes);

    if ($event === NULL) {
      $this->session->flash(
            StateInterface::FAILED,
            Translation::get('event_unsuccessfully_created')
        );

      return FALSE;
    }

    $this->session->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              Translation::get('event_successfully_created'),
              $this->title
          )
      );

    return TRUE;
  }

}
