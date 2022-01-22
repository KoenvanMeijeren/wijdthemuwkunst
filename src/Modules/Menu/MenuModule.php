<?php
declare(strict_types=1);

namespace Modules\Menu;

use Modules\Menu\Controller\MenuController;
use System\Module\Module;
use System\Module\ModuleBase;

/**
 * Provides a module for maintaining the menu.
 *
 * @package Modules\Menu
 */
#[Module(
  name: 'Menu',
  routes: [
    MenuController::class,
  ]
)]
class MenuModule extends ModuleBase {

}
