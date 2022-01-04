<?php

use Components\Route\Router;
use Components\Route\RouteRights;
use Modules\User\Controller\AccountController;
use Modules\User\Controller\UserAccountController;

// User account routes.
Router::prefix('admin/user/account')->group(static function () {
  Router::get('', UserAccountController::class,
    'index', RouteRights::ADMIN, 'entity.user.index');
  Router::post('store/data', UserAccountController::class,
    'storeData', RouteRights::ADMIN, 'entity.user.saveData');
  Router::post('store/password', UserAccountController::class,
    'storePassword', RouteRights::ADMIN, 'entity.user.savePassword');
});

// Account routes.
Router::prefix('admin/account')->group(static function () {
  Router::get('', AccountController::class,
    'index', RouteRights::SUPER_ADMIN, 'entity.account.collection');
  Router::get('create', AccountController::class,
    'create', RouteRights::SUPER_ADMIN, 'entity.account.create');
  Router::post('create/store', AccountController::class,
    'store', RouteRights::SUPER_ADMIN, 'entity.account.save');
  Router::get('edit/{slug}', AccountController::class,
    'edit', RouteRights::SUPER_ADMIN, 'entity.account.edit');
  Router::post('edit/{slug}/store/data', AccountController::class,
    'storeData', RouteRights::SUPER_ADMIN, 'entity.account.saveData');
  Router::post('edit/{slug}/store/email', AccountController::class,
    'storeEmail', RouteRights::SUPER_ADMIN, 'entity.account.saveEmail');
  Router::post('edit/{slug}/store/password', AccountController::class,
    'storePassword', RouteRights::SUPER_ADMIN, 'entity.account.savePassword');
  Router::post('block/{slug}', AccountController::class,
    'block', RouteRights::SUPER_ADMIN, 'entity.account.block');
  Router::post('unblock/{slug}', AccountController::class,
    'unblock', RouteRights::SUPER_ADMIN, 'entity.account.unblock');
  Router::post('delete/{slug}', AccountController::class,
    'destroy', RouteRights::SUPER_ADMIN, 'entity.account.destroy');
});
