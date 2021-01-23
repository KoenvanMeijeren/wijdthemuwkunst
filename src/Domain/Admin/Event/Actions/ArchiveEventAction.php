<?php

namespace Domain\Admin\Event\Actions;

use Components\Translation\TranslationOld;
use System\StateInterface;

/**
 *
 */
class ArchiveEventAction extends BaseEventAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->event->update($this->eventRepository->getId(), [
      'event_is_archived' => '1',
    ]);

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              TranslationOld::get('event_successfully_archived'),
              $this->eventRepository->getTitle()
          )
      );

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    if (!$this->eventRepository->isPublished()) {
      $this->session()->flash(
            StateInterface::FAILED,
            sprintf(
                TranslationOld::get('event_cannot_archive_not_published'),
                $this->eventRepository->getTitle()
            )
        );

      return FALSE;
    }

    return parent::authorize();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    return TRUE;
  }

}
