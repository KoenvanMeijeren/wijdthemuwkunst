<?php

use Components\Route\Router;
use Components\Route\RouteRights;
use Modules\Setting\Controllers\SettingsControllers;

Router::prefix('admin/configuration/settings')->group(static function () {
  Router::get('', SettingsControllers::class,
    'index', RouteRights::ADMIN);
  Router::get('setting/create', SettingsControllers::class,
    'create', RouteRights::ADMIN);
  Router::post('setting/create/store', SettingsControllers::class,
    'store', RouteRights::ADMIN);
  Router::get('setting/edit/{slug}', SettingsControllers::class,
    'edit', RouteRights::ADMIN);
  Router::post('setting/edit/{slug}/update', SettingsControllers::class,
    'update', RouteRights::ADMIN);
  Router::post('setting/delete/{slug}', SettingsControllers::class,
    'destroy', RouteRights::ADMIN);
});
