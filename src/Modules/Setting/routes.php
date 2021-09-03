<?php

use Components\Route\Router;
use Modules\Setting\Controllers\SettingsControllers;
use Modules\User\Entity\AccountInterface;

Router::prefix('admin/configuration/settings')->group(static function () {
  Router::get('', SettingsControllers::class,
    'index', AccountInterface::ADMIN);
  Router::get('setting/create', SettingsControllers::class,
    'create', AccountInterface::ADMIN);
  Router::post('setting/create/store', SettingsControllers::class,
    'store', AccountInterface::ADMIN);
  Router::get('setting/edit/{slug}', SettingsControllers::class,
    'edit', AccountInterface::ADMIN);
  Router::post('setting/edit/{slug}/update', SettingsControllers::class,
    'update', AccountInterface::ADMIN);
  Router::post('setting/delete/{slug}', SettingsControllers::class,
    'destroy', AccountInterface::ADMIN);
});
