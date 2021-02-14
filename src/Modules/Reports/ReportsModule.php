<?php
declare(strict_types=1);

namespace Modules\Reports;

use System\Module\ModuleBase;

/**
 * Provides a module for reports.
 *
 * @package Modules\Reports
 */
class ReportsModule extends ModuleBase {

  /**
   * {@inheritDoc}
   */
  public function getName(): string {
    return 'Reports';
  }

}
