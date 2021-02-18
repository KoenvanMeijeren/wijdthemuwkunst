<?php
declare(strict_types=1);

namespace Modules\File;

use System\Module\ModuleBase;

/**
 * Provides a module for files.
 *
 * @package Modules\Reports
 */
class FileModule extends ModuleBase {

  /**
   * {@inheritDoc}
   */
  public function getName(): string {
    return 'File';
  }

}
