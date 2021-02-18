<?php
declare(strict_types=1);

namespace Modules\Menu;

use System\Module\ModuleBase;

/**
 * Provides a module for maintaining the menu.
 *
 * @package Modules\Menu
 */
class MenuModule extends ModuleBase {

  /**
   * {@inheritDoc}
   */
  public function getName(): string {
    return 'Menu';
  }
}
