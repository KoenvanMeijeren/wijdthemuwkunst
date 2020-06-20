<?php

declare(strict_types=1);


namespace Domain\Admin\Settings\Actions;

use Src\State\State;
use Src\Translation\Translation;

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

    $this->session->flash(
          State::SUCCESSFUL,
          sprintf(
              Translation::get('setting_successful_updated'),
              $this->key
          )
      );

    return TRUE;
  }

}
