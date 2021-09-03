<?php

use Components\Route\Router;
use Modules\File\Controllers\UploadFileController;
use Modules\User\Entity\AccountInterface;

// File routes.
Router::prefix('admin/upload')->group(static function () {
  Router::post('file', UploadFileController::class,
    'store', AccountInterface::ADMIN);
  Router::post('thumbnail', UploadFileController::class,
    'thumbnail', AccountInterface::ADMIN);
  Router::post('banner', UploadFileController::class,
    'banner', AccountInterface::ADMIN);
});
