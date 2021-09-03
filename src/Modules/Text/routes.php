<?php

use Components\Route\Router;
use Modules\Text\Controllers\TextController;
use Modules\User\Entity\AccountInterface;

Router::prefix('admin/configuration/texts')->group(static function () {
  Router::get('', TextController::class,
    'index', AccountInterface::ADMIN);

  Router::get('text/create', TextController::class,
    'create', AccountInterface::ADMIN);
  Router::post('text/create/store', TextController::class,
    'store', AccountInterface::ADMIN);

  Router::get('text/edit/{slug}', TextController::class,
    'edit', AccountInterface::ADMIN);
  Router::post('text/edit/{slug}/update', TextController::class,
    'update', AccountInterface::ADMIN);

  Router::post('text/delete/{slug}', TextController::class,
    'destroy', AccountInterface::ADMIN);
});
