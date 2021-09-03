<?php

use Components\Route\Router;
use Components\Route\RouterInterface;
use Modules\Page\Controllers\AdminPageController;
use Modules\Page\Controllers\PageController;
use Modules\User\Entity\AccountInterface;

Router::get('', PageController::class, 'index');
Router::get('index', PageController::class, 'index');
Router::get(RouterInterface::URL_PAGE_NOT_FOUND, PageController::class, 'findOr404');

Router::prefix('admin/content/pages')->group(static function () {
  Router::get('', AdminPageController::class, 'index', AccountInterface::ADMIN);
  Router::get('page/create', AdminPageController::class, 'create', AccountInterface::ADMIN);
  Router::post('page/create/store', AdminPageController::class, 'store', AccountInterface::ADMIN);
  Router::get('page/edit/{slug}', AdminPageController::class, 'edit', AccountInterface::ADMIN);
  Router::post('page/edit/{slug}/remove/banner', AdminPageController::class, 'removeBanner', AccountInterface::ADMIN);
  Router::post('page/edit/{slug}/remove/thumbnail', AdminPageController::class, 'removeThumbnail', AccountInterface::ADMIN);
  Router::post('page/edit/{slug}/store', AdminPageController::class, 'update', AccountInterface::ADMIN);
  Router::post('page/publish/{slug}', AdminPageController::class, 'publish', AccountInterface::ADMIN);
  Router::post('page/unpublish/{slug}', AdminPageController::class, 'unPublish', AccountInterface::ADMIN);
  Router::post('page/delete/{slug}', AdminPageController::class, 'destroy', AccountInterface::ADMIN);
});
