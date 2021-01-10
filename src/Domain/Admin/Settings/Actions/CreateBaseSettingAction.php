<?php

declare(strict_types=1);


namespace Domain\Admin\Settings\Actions;

use Domain\Admin\Accounts\User\Models\User;
use Src\Translation\Translation;
use System\StateInterface;

/**
 *
 */
final class CreateBaseSettingAction extends BaseSettingAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $setting = $this->setting->firstOrCreate([
      $this->setting->key => $this->key,
      $this->setting->valueKey => $this->value,
    ]);

    if ($setting !== NULL) {
      $this->session()->flash(
            StateInterface::SUCCESSFUL,
            sprintf(
                Translation::get('setting_successful_created'),
                $this->key
            )
        );

      return TRUE;
    }

    $this->session()->flash(
          StateInterface::FAILED,
          sprintf(
              Translation::get('setting_unsuccessful_created'),
              $this->key
          )
      );

    return FALSE;
  }

  /**
   *
   */
  public function authorize(): bool {
    $user = new User();
    if ($user->getRights() !== User::DEVELOPER) {
      $this->session()->flash(
            StateInterface::FAILED,
            Translation::get('setting_creation_not_allowed')
        );

      return FALSE;
    }

    return parent::authorize();
  }

}
