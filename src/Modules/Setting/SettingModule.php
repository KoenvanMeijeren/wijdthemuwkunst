<?php
declare(strict_types=1);

namespace Modules\Setting;

use Modules\Setting\Controllers\SettingsControllers;
use System\Module\Module;
use System\Module\ModuleBase;

/**
 * Provides a module for settings.
 *
 * @package Modules\Setting
 */
#[Module(
  name: 'Setting',
  routes: [
    SettingsControllers::class,
  ]
)]
final class SettingModule extends ModuleBase {

}
