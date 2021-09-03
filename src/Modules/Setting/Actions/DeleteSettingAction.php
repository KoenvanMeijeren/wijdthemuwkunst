<?php
declare(strict_types=1);

namespace Modules\Setting\Actions;

use Components\Translation\TranslationOld;
use Modules\User\Entity\AccountInterface;
use System\Entity\EntityInterface;
use System\StateInterface;

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
    if ($status === EntityInterface::SAVED_DELETED) {
      $this->session()->flash(StateInterface::SUCCESSFUL,
        sprintf(TranslationOld::get('setting_successful_deleted'), $this->entity->getKey())
      );

      return TRUE;
    }

    $this->session()->flash(StateInterface::SUCCESSFUL,
      sprintf(TranslationOld::get('setting_unsuccessful_deleted'), $this->entity->getKey())
    );

    return FALSE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    if ($this->user()->getRights() !== AccountInterface::DEVELOPER) {
      $this->session()->flash(StateInterface::FAILED, TranslationOld::get('setting_destroy_not_allowed'));

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
