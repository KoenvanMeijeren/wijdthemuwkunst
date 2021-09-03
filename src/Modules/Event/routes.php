<?php
declare(strict_types=1);

use Components\Route\Router;
use Modules\Event\Controller\AdminEventController;
use Modules\Event\Controller\EventArchiveController;
use Modules\Event\Controller\EventController;
use Modules\User\Entity\AccountInterface;

Router::get('concerten', EventController::class, 'index');
Router::get('concerten/concert/{slug}', EventController::class, 'show');
Router::get('concerten/historie', EventArchiveController::class, 'index');
Router::get('concerten/historie/concert/{slug}', EventArchiveController::class, 'show');

// Events routes.
Router::prefix('admin/content/events')->group(static function () {
  Router::get('', AdminEventController::class, 'index', AccountInterface::ADMIN);
  Router::get('event/create', AdminEventController::class, 'create', AccountInterface::ADMIN);
  Router::post('event/create/store', AdminEventController::class, 'store', AccountInterface::ADMIN);
  Router::get('event/edit/{slug}', AdminEventController::class, 'edit', AccountInterface::ADMIN);
  Router::post('event/edit/{slug}/remove/banner', AdminEventController::class, 'removeBanner', AccountInterface::ADMIN);
  Router::post('event/edit/{slug}/remove/thumbnail', AdminEventController::class, 'removeThumbnail', AccountInterface::ADMIN);
  Router::post('event/edit/{slug}/store', AdminEventController::class, 'update', AccountInterface::ADMIN);
  Router::post('event/publish/{slug}', AdminEventController::class, 'publish', AccountInterface::ADMIN);
  Router::post('event/unpublish/{slug}', AdminEventController::class, 'unPublish', AccountInterface::ADMIN);
  Router::post('event/archive/{slug}', AdminEventController::class, 'archive', AccountInterface::ADMIN);
  Router::post('event/activate/{slug}', AdminEventController::class, 'activate', AccountInterface::ADMIN);
  Router::post('event/delete/{slug}', AdminEventController::class, 'destroy', AccountInterface::ADMIN);
});
