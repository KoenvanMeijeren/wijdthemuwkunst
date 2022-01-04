<?php

use Components\Route\Router;
use Components\Route\RouteRights;
use Components\Route\RouterInterface;
use Modules\Page\Controllers\AdminPageController;
use Modules\Page\Controllers\PageController;

Router::get('', PageController::class, 'index');
Router::get('index', PageController::class, 'index');
Router::get(RouterInterface::URL_PAGE_NOT_FOUND, PageController::class, 'findOr404');

Router::prefix('admin/content/pages')->group(static function () {
  Router::get('', AdminPageController::class, 'index', RouteRights::ADMIN);
  Router::get('page/create', AdminPageController::class, 'create', RouteRights::ADMIN);
  Router::post('page/create/store', AdminPageController::class, 'store', RouteRights::ADMIN);
  Router::get('page/edit/{slug}', AdminPageController::class, 'edit', RouteRights::ADMIN);
  Router::post('page/edit/{slug}/remove/banner', AdminPageController::class, 'removeBanner', RouteRights::ADMIN);
  Router::post('page/edit/{slug}/remove/thumbnail', AdminPageController::class, 'removeThumbnail', RouteRights::ADMIN);
  Router::post('page/edit/{slug}/store', AdminPageController::class, 'update', RouteRights::ADMIN);
  Router::post('page/publish/{slug}', AdminPageController::class, 'publish', RouteRights::ADMIN);
  Router::post('page/unpublish/{slug}', AdminPageController::class, 'unPublish', RouteRights::ADMIN);
  Router::post('page/delete/{slug}', AdminPageController::class, 'destroy', RouteRights::ADMIN);
});
