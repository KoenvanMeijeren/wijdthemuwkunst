<?php

use Components\Route\Router;
use Modules\User\Controller\AccountController;
use Modules\User\Controller\UserAccountController;
use Modules\User\Entity\AccountInterface;

// User account routes.
Router::prefix('admin/user/account')->group(static function () {
  Router::get('', UserAccountController::class,
    'index', AccountInterface::ADMIN);
  Router::post('store/data', UserAccountController::class,
    'storeData', AccountInterface::ADMIN);
  Router::post('store/password', UserAccountController::class,
    'storePassword', AccountInterface::ADMIN);
});

// Account routes.
Router::prefix('admin/account')->group(static function () {
  Router::get('', AccountController::class,
    'index', AccountInterface::SUPER_ADMIN);
  Router::get('create', AccountController::class,
    'create', AccountInterface::SUPER_ADMIN);
  Router::post('create/store', AccountController::class,
    'store', AccountInterface::SUPER_ADMIN);
  Router::get('edit/{slug}', AccountController::class,
    'edit', AccountInterface::SUPER_ADMIN);
  Router::post('edit/{slug}/store/data', AccountController::class,
    'storeData', AccountInterface::SUPER_ADMIN);
  Router::post('edit/{slug}/store/email', AccountController::class,
    'storeEmail', AccountInterface::SUPER_ADMIN);
  Router::post('edit/{slug}/store/password', AccountController::class,
    'storePassword', AccountInterface::SUPER_ADMIN);
  Router::post('block/{slug}', AccountController::class,
    'block', AccountInterface::SUPER_ADMIN);
  Router::post('unblock/{slug}', AccountController::class,
    'unblock', AccountInterface::SUPER_ADMIN);
  Router::post('delete/{slug}', AccountController::class,
    'destroy', AccountInterface::SUPER_ADMIN);
});
