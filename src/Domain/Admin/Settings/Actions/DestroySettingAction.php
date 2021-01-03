<?php

declare(strict_types=1);


namespace Domain\Admin\Settings\Actions;

use Domain\Admin\Accounts\User\Models\User;
use System\StateInterface;
use Src\Translation\Translation;

/**
 *
 */
final class DestroySettingAction extends BaseSettingAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->setting->delete($this->setting->getId());

    if ($this->setting->find($this->setting->getId()) === NULL) {
      $this->session->flash(
            StateInterface::SUCCESSFUL,
            sprintf(
                Translation::get('setting_successful_deleted'),
                $this->settingRepository->getKey()
            )
        );

      return TRUE;
    }

    $this->session->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              Translation::get('setting_unsuccessful_deleted'),
              $this->settingRepository->getKey()
          )
      );
    return FALSE;
  }

  /**
   *
   */
  protected function authorize(): bool {
    $user = new User();
    if ($user->getRights() !== User::DEVELOPER) {
      $this->session->flash(
            StateInterface::FAILED,
            Translation::get('setting_destroy_not_allowed')
        );

      return FALSE;
    }

    return parent::authorize();
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    return TRUE;
  }

}
