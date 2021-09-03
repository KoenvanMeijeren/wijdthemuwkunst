<?php

use Components\Route\Router;
use Modules\Contact\Controller\AdminContactController;
use Modules\Contact\Controller\ContactController;
use Modules\User\Entity\AccountInterface;

Router::post('contact', ContactController::class, 'send');

Router::prefix('admin/content/contact')->group(static function () {
  Router::get('', AdminContactController::class,
    'index', AccountInterface::ADMIN);
  Router::get('filter', AdminContactController::class,
    'showByDate', AccountInterface::ADMIN);
  Router::post('delete/{slug}', AdminContactController::class,
    'destroy', AccountInterface::ADMIN);
});
