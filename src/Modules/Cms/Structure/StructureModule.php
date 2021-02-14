<?php
declare(strict_types=1);

namespace Modules\Cms\Structure;

use System\Module\ModuleBase;

/**
 * Provides a module for the structure of the cms.
 *
 * @package Modules\Cms\Structure
 */
class StructureModule extends ModuleBase {

  /**
   * {@inheritDoc}
   */
  public function getName(): string {
    return 'Cms_Structure';
  }

}
