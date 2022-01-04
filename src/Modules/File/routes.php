<?php

use Components\Route\Router;
use Components\Route\RouteRights;
use Modules\File\Controllers\UploadFileController;

// File routes.
Router::prefix('admin/upload')->group(static function () {
  Router::post('file', UploadFileController::class,
    'store', RouteRights::ADMIN);
  Router::post('thumbnail', UploadFileController::class,
    'thumbnail', RouteRights::ADMIN);
  Router::post('banner', UploadFileController::class,
    'banner', RouteRights::ADMIN);
});
