<?php

use Components\Route\Router;
use Domain\Admin\Accounts\User\Models\User;
use Modules\Contact\Controller\AdminContactController;
use Modules\Contact\Controller\ContactController;

Router::post('contact', ContactController::class, 'send');

Router::prefix('admin/content/contact')->group(static function () {
  Router::get('', AdminContactController::class,
    'index', User::ADMIN);
  Router::get('filter', AdminContactController::class,
    'showByDate', User::ADMIN);
  Router::post('delete/{slug}', AdminContactController::class,
    'destroy', User::ADMIN);
});
