<?php

use Domain\Admin\Accounts\User\Models\User;
use Components\Route\Router;
use Modules\User\Controller\AccountController;

// Account routes.
Router::prefix('admin/account')->group(static function () {
  Router::get('', AccountController::class,
    'index', User::SUPER_ADMIN);
  Router::get('create', AccountController::class,
    'create', User::SUPER_ADMIN);
  Router::post('create/store', AccountController::class,
    'store', User::SUPER_ADMIN);
  Router::get('edit/{slug}', AccountController::class,
    'edit', User::SUPER_ADMIN);
  Router::post('edit/{slug}/store/data', AccountController::class,
    'storeData', User::SUPER_ADMIN);
  Router::post('edit/{slug}/store/email', AccountController::class,
    'storeEmail', User::SUPER_ADMIN);
  Router::post('edit/{slug}/store/password', AccountController::class,
    'storePassword', User::SUPER_ADMIN);
  Router::post('block/{slug}', AccountController::class,
    'block', User::SUPER_ADMIN);
  Router::post('unblock/{slug}', AccountController::class,
    'unblock', User::SUPER_ADMIN);
  Router::post('delete/{slug}', AccountController::class,
    'destroy', User::SUPER_ADMIN);
});
