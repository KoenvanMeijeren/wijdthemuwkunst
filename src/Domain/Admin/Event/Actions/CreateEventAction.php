<?php

namespace Domain\Admin\Event\Actions;

use Components\Translation\TranslationOld;
use System\StateInterface;

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
      $this->session()->flash(
            StateInterface::FAILED,
            TranslationOld::get('event_unsuccessfully_created')
        );

      return FALSE;
    }

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              TranslationOld::get('event_successfully_created'),
              $this->title
          )
      );

    return TRUE;
  }

}
