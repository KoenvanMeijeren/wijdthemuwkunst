<?php

use Components\Route\Router;
use Components\Route\RouteRights;
use Modules\Reports\Controllers\ReportsController;

// Reports routes.
Router::prefix('admin/reports')->group(static function () {
  // Application routes.
  Router::get('application', ReportsController::class,
    'application', RouteRights::DEVELOPER);

  // Logs routes.
  Router::get('logs', ReportsController::class,
    'logs', RouteRights::DEVELOPER);

  // Storage routes.
  Router::get('storage', ReportsController::class,
    'storage', RouteRights::DEVELOPER);
});
