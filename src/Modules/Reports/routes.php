<?php

use Components\Route\Router;
use Domain\Admin\Accounts\User\Models\User;
use Modules\Reports\Controllers\ReportsController;

// Reports routes.
Router::prefix('admin/reports')->group(static function () {
  // Application routes.
  Router::get('application', ReportsController::class,
    'application', User::DEVELOPER);

  // Logs routes.
  Router::get('logs', ReportsController::class,
    'logs', User::DEVELOPER);

  // Storage routes.
  Router::get('storage', ReportsController::class,
    'storage', User::DEVELOPER);
});
