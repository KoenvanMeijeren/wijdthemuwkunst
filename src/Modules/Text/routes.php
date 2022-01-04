<?php

use Components\Route\Router;
use Components\Route\RouteRights;
use Modules\Text\Controllers\TextController;

Router::prefix('admin/configuration/texts')->group(static function () {
  Router::get('', TextController::class,
    'index', RouteRights::ADMIN);

  Router::get('text/create', TextController::class,
    'create', RouteRights::ADMIN);
  Router::post('text/create/store', TextController::class,
    'store', RouteRights::ADMIN);

  Router::get('text/edit/{slug}', TextController::class,
    'edit', RouteRights::ADMIN);
  Router::post('text/edit/{slug}/update', TextController::class,
    'update', RouteRights::ADMIN);

  Router::post('text/delete/{slug}', TextController::class,
    'destroy', RouteRights::ADMIN);
});
