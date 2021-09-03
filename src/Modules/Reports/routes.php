<?php

use Components\Route\Router;
use Modules\Reports\Controllers\ReportsController;
use Modules\User\Entity\AccountInterface;

// Reports routes.
Router::prefix('admin/reports')->group(static function () {
  // Application routes.
  Router::get('application', ReportsController::class,
    'application', AccountInterface::DEVELOPER);

  // Logs routes.
  Router::get('logs', ReportsController::class,
    'logs', AccountInterface::DEVELOPER);

  // Storage routes.
  Router::get('storage', ReportsController::class,
    'storage', AccountInterface::DEVELOPER);
});
