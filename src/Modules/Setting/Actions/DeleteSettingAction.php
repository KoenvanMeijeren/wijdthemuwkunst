<?php
declare(strict_types=1);

namespace Modules\Setting\Actions;

use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use System\Entity\Status\EntitySaveStatus;
use System\State;

/**
 * Provides a class for the delete setting action.
 *
 * @package Modules\Setting\Actions
 */
final class DeleteSettingAction extends BaseSettingAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $status = $this->entity->delete();
    if ($status === EntitySaveStatus::SAVED_DELETED) {
      $this->session()->flash(State::SUCCESSFUL->value,
        sprintf(TranslationOld::get('setting_successful_deleted'), $this->entity->getKey())
      );

      return TRUE;
    }

    $this->session()->flash(State::SUCCESSFUL->value,
      sprintf(TranslationOld::get('setting_unsuccessful_deleted'), $this->entity->getKey())
    );

    return FALSE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    if ($this->user()->getRouteRights()->hasAccessForbidden(RouteRights::DEVELOPER)) {
      $this->session()->flash(State::FAILED->value, TranslationOld::get('setting_destroy_not_allowed'));

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
