<?php

use Components\Route\Router;
use Components\Route\RouterInterface;
use Domain\Admin\Accounts\User\Models\User;
use Modules\Page\Controllers\AdminPageController;
use Modules\Page\Controllers\PageController;

Router::get('', PageController::class, 'index');
Router::get('index', PageController::class, 'index');
Router::get(RouterInterface::URL_PAGE_NOT_FOUND, PageController::class, 'findOr404');

Router::prefix('admin/content/pages')->group(static function () {
  Router::get('', AdminPageController::class, 'index', User::ADMIN);
  Router::get('page/create', AdminPageController::class, 'create', User::ADMIN);
  Router::post('page/create/store', AdminPageController::class, 'store', User::ADMIN);
  Router::get('page/edit/{slug}', AdminPageController::class, 'edit', User::ADMIN);
  Router::post('page/edit/{slug}/remove/banner', AdminPageController::class, 'removeBanner', User::ADMIN);
  Router::post('page/edit/{slug}/remove/thumbnail', AdminPageController::class, 'removeThumbnail', User::ADMIN);
  Router::post('page/edit/{slug}/store', AdminPageController::class, 'update', User::ADMIN);
  Router::post('page/publish/{slug}', AdminPageController::class, 'publish', User::ADMIN);
  Router::post('page/unpublish/{slug}', AdminPageController::class, 'unPublish', User::ADMIN);
  Router::post('page/delete/{slug}', AdminPageController::class, 'destroy', User::ADMIN);
});
