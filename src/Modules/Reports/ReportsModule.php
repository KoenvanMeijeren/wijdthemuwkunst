<?php
declare(strict_types=1);

namespace Modules\Reports;

use Modules\Reports\Controllers\ReportsController;
use System\Module\Module;
use System\Module\ModuleBase;

/**
 * Provides a module for reports.
 *
 * @package Modules\Reports
 */
#[Module(
  name: 'Reports',
  routes: [
    ReportsController::class,
  ]
)]
class ReportsModule extends ModuleBase {

}
