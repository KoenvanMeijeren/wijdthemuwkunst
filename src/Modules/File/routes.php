<?php

use Components\Route\Router;
use Domain\Admin\Accounts\User\Models\User;
use Modules\File\Controllers\UploadFileController;

// File routes.
Router::prefix('admin/upload')->group(static function () {
  Router::post('file', UploadFileController::class,
    'store', User::ADMIN);
  Router::post('thumbnail', UploadFileController::class,
    'thumbnail', User::ADMIN);
  Router::post('banner', UploadFileController::class,
    'banner', User::ADMIN);
});
