<?php

namespace Modules\Event\Action;

use Components\Translation\TranslationOld;
use System\State;

/**
 * Provides an action for archiving events.
 *
 * @package Modules\Event\Action
 */
class ArchiveEventAction extends EventActionBase {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setArchived(TRUE);
    $this->entity->save();

    $this->session()->flash(
          State::SUCCESSFUL->value,
          sprintf(
              TranslationOld::get('event_successfully_archived'),
              $this->entity->getTitle()
          )
      );

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    if (!$this->entity->isPublished()) {
      $this->session()->flash(
            State::FAILED->value,
            sprintf(
                TranslationOld::get('event_cannot_archive_not_published'),
                $this->entity->getTitle()
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
