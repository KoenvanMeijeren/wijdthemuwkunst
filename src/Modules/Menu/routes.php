<?php

use Components\Route\Router;
use Modules\Menu\Controller\MenuController;
use Modules\User\Entity\AccountInterface;

Router::prefix('admin/structure/menu')->group(static function () {
  Router::get('', MenuController::class,
    'index', AccountInterface::ADMIN);
  Router::get('item/create', MenuController::class,
    'create', AccountInterface::ADMIN);
  Router::post('item/create/store', MenuController::class,
    'store', AccountInterface::ADMIN);
  Router::get('item/edit/{slug}', MenuController::class,
    'edit', AccountInterface::ADMIN);
  Router::post('item/edit/{slug}/update', MenuController::class,
    'update', AccountInterface::ADMIN);
  Router::post('item/delete/{slug}', MenuController::class,
    'destroy', AccountInterface::ADMIN);
});
