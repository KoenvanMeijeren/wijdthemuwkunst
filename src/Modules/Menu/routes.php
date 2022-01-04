<?php

use Components\Route\Router;
use Components\Route\RouteRights;
use Modules\Menu\Controller\MenuController;

Router::prefix('admin/structure/menu')->group(static function () {
  Router::get('', MenuController::class,
    'index', RouteRights::ADMIN);
  Router::get('item/create', MenuController::class,
    'create', RouteRights::ADMIN);
  Router::post('item/create/store', MenuController::class,
    'store', RouteRights::ADMIN);
  Router::get('item/edit/{slug}', MenuController::class,
    'edit', RouteRights::ADMIN);
  Router::post('item/edit/{slug}/update', MenuController::class,
    'update', RouteRights::ADMIN);
  Router::post('item/delete/{slug}', MenuController::class,
    'destroy', RouteRights::ADMIN);
});
