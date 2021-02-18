<?php
declare(strict_types=1);

namespace Modules\Slug;

use System\Module\ModuleBase;

/**
 * Provides a module for maintaining the menu.
 *
 * @package Modules\Menu
 */
class SlugModule extends ModuleBase {

  /**
   * {@inheritDoc}
   */
  public function getName(): string {
    return 'Slug';
  }
}
