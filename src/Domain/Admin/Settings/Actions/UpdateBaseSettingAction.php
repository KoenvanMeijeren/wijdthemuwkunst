<?php

declare(strict_types=1);


namespace Domain\Admin\Settings\Actions;

use Components\Translation\TranslationOld;
use System\StateInterface;

/**
 *
 */
final class UpdateBaseSettingAction extends BaseSettingAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->setting->update($this->setting->getId(), [
      $this->setting->key => $this->key,
      $this->setting->valueKey => $this->value,
    ]);

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              TranslationOld::get('setting_successful_updated'),
              $this->key
          )
      );

    return TRUE;
  }

}
