<?php

/**
 * @file
 * Web routes.
 */

declare(strict_types=1);

use Components\Route\Router;
use Modules\Authentication\Controllers\AuthenticationController;
use Modules\User\Entity\AccountInterface;

// Authorization routes.
Router::prefix('admin')->group(static function () {
  Router::get('', AuthenticationController::class, 'index');
  Router::post('login', AuthenticationController::class, 'login');
  Router::get('logout', AuthenticationController::class, 'logout', AccountInterface::ADMIN);
});
