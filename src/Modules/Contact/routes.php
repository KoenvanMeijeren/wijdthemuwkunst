<?php

use Components\Route\Router;
use Components\Route\RouteRights;
use Modules\Contact\Controller\AdminContactController;
use Modules\Contact\Controller\ContactController;

Router::post('contact', ContactController::class, 'send');

Router::prefix('admin/content/contact')->group(static function () {
  Router::get('', AdminContactController::class,
    'index', RouteRights::ADMIN);
  Router::get('filter', AdminContactController::class,
    'showByDate', RouteRights::ADMIN);
  Router::post('delete/{slug}', AdminContactController::class,
    'destroy', RouteRights::ADMIN);
});
