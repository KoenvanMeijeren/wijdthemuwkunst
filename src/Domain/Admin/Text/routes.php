<?php

use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Text\Controllers\TextController;
use System\Router;

Router::prefix('admin/configuration/texts')->group(static function () {
  Router::get('', TextController::class,
    'index', User::ADMIN);

  Router::get('text/create', TextController::class,
    'create', User::ADMIN);
  Router::post('text/create/store', TextController::class,
    'store', User::ADMIN);

  Router::get('text/edit/{slug}', TextController::class,
    'edit', User::ADMIN);
  Router::post('text/edit/{slug}/update', TextController::class,
    'update', User::ADMIN);

  Router::post('text/delete/{slug}', TextController::class,
    'destroy', User::ADMIN);
});
