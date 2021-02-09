<?php
declare(strict_types=1);

namespace Modules\Setting;

use System\Module\ModuleBase;

/**
 * Provides a module for settings.
 *
 * @package Modules\Setting
 */
class SettingModule extends ModuleBase {

  /**
   * {@inheritDoc}
   */
  public function getName(): string {
    return 'Setting';
  }

}
