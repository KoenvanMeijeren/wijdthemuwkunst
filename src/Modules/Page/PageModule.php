<?php
declare(strict_types=1);

namespace Modules\Page;

use System\Module\ModuleBase;

/**
 * Provides a module for pages.
 *
 * @package Modules\Page
 */
class PageModule extends ModuleBase {

  /**
   * {@inheritDoc}
   */
  public function getName(): string {
    return "Page";
  }

}
