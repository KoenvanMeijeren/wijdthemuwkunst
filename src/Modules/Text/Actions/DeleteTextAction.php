<?php

namespace Modules\Text\Actions;

use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use System\Entity\Status\EntitySaveStatus;
use System\State;

/**
 * Provides a class for the delete text action.
 *
 * @package Domain\Admin\Text\Actions
 */
final class DeleteTextAction extends BaseTextAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $status = $this->entity->delete();
    if ($status === EntitySaveStatus::SAVED_DELETED) {
      $this->session()->flash(State::SUCCESSFUL->value,
        sprintf(TranslationOld::get('text_successful_deleted'), $this->entity->getKey())
      );

      return TRUE;
    }

    $this->session()->flash(State::SUCCESSFUL->value,
      sprintf(TranslationOld::get('text_unsuccessful_deleted'), $this->entity->getKey())
    );

    return FALSE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    if ($this->user()->getRouteRights()->hasAccessForbidden(RouteRights::DEVELOPER)) {
      $this->session()->flash(State::FAILED->value, TranslationOld::get('text_destroy_not_allowed'));

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
