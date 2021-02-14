<?php

use Components\Route\Router;
use Domain\Admin\Accounts\User\Models\User;
use Modules\ContactForm\Controller\ContactFormController;

Router::prefix('admin/content/contact-form')->group(static function () {
  Router::get('', ContactFormController::class,
    'index', User::ADMIN);
  Router::get('filter', ContactFormController::class,
    'showByDate', User::ADMIN);
  Router::post('delete/{slug}', ContactFormController::class,
    'destroy', User::ADMIN);
});
