<?php
declare(strict_types=1);

namespace Modules\Setting\Actions;

use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use System\State;

/**
 * Provides a class for the create setting action.
 *
 * @package Modules\Setting\Actions
 */
final class CreateSettingAction extends BaseSettingAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setKey($this->request()->post('key'));
    $this->entity->setValue($this->request()->post('value'));

    return $this->saveEntity();
  }

  /**
   * {@inheritDoc}
   */
  public function authorize(): bool {
    if ($this->currentUser()->getRouteRights()->hasAccessForbidden(RouteRights::DEVELOPER)) {
      $this->session()->flash(State::FAILED->value, TranslationOld::get('setting_creation_not_allowed'));

      return FALSE;
    }

    return parent::authorize();
  }

}
