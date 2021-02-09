<?php

use Components\Route\Router;
use Domain\Admin\Accounts\User\Models\User;
use Modules\Setting\Controllers\SettingsControllers;

Router::prefix('admin/configuration/settings')->group(static function () {
  Router::get('', SettingsControllers::class,
    'index', User::ADMIN);
  Router::get('setting/create', SettingsControllers::class,
    'create', User::ADMIN);
  Router::post('setting/create/store', SettingsControllers::class,
    'store', User::ADMIN);
  Router::get('setting/edit/{slug}', SettingsControllers::class,
    'edit', User::ADMIN);
  Router::post('setting/edit/{slug}/update', SettingsControllers::class,
    'update', User::ADMIN);
  Router::post('setting/delete/{slug}', SettingsControllers::class,
    'destroy', User::ADMIN);
});
