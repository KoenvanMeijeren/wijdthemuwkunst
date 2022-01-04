<?php
declare(strict_types=1);

namespace Modules\Setting\Actions;

use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use Modules\User\Entity\AccountInterface;
use System\StateInterface;

/**
 * Provides a class for the update text action.
 *
 * @package Modules\Setting\Actions
 */
final class UpdateSettingAction extends BaseSettingAction {

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
  protected function authorize(): bool {
    if ($this->user()->getRouteRights()->hasAccessForbidden(RouteRights::DEVELOPER)
      && $this->request()->post('key') !== $this->entity->getKey()) {
      $this->session()->flash(StateInterface::FAILED, TranslationOld::get('setting_editing_key_not_allowed'));

      return FALSE;
    }

    return parent::authorize();
  }

}
