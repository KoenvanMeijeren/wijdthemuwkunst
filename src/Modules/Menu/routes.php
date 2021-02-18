<?php

use Components\Route\Router;
use Domain\Admin\Accounts\User\Models\User;
use Modules\Menu\Controller\MenuController;

Router::prefix('admin/structure/menu')->group(static function () {
  Router::get('', MenuController::class,
    'index', User::ADMIN);
  Router::get('item/create', MenuController::class,
    'create', User::ADMIN);
  Router::post('item/create/store', MenuController::class,
    'store', User::ADMIN);
  Router::get('item/edit/{slug}', MenuController::class,
    'edit', User::ADMIN);
  Router::post('item/edit/{slug}/update', MenuController::class,
    'update', User::ADMIN);
  Router::post('item/delete/{slug}', MenuController::class,
    'destroy', User::ADMIN);
});
