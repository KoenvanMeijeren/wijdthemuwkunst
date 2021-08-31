<?php
declare(strict_types=1);

use Components\Route\Router;
use Domain\Admin\Accounts\User\Models\User;
use Modules\Event\Controller\AdminEventController;
use Modules\Event\Controller\EventArchiveController;
use Modules\Event\Controller\EventController;

Router::get('concerten', EventController::class, 'index');
Router::get('concerten/concert/{slug}', EventController::class, 'show');
Router::get('concerten/historie', EventArchiveController::class, 'index');
Router::get('concerten/historie/concert/{slug}', EventArchiveController::class, 'show');

// Events routes.
Router::prefix('admin/content/events')->group(static function () {
  Router::get('', AdminEventController::class, 'index', User::ADMIN);
  Router::get('event/create', AdminEventController::class, 'create', User::ADMIN);
  Router::post('event/create/store', AdminEventController::class, 'store', User::ADMIN);
  Router::get('event/edit/{slug}', AdminEventController::class, 'edit', User::ADMIN);
  Router::post('event/edit/{slug}/remove/banner', AdminEventController::class, 'removeBanner', User::ADMIN);
  Router::post('event/edit/{slug}/remove/thumbnail', AdminEventController::class, 'removeThumbnail', User::ADMIN);
  Router::post('event/edit/{slug}/store', AdminEventController::class, 'update', User::ADMIN);
  Router::post('event/publish/{slug}', AdminEventController::class, 'publish', User::ADMIN);
  Router::post('event/unpublish/{slug}', AdminEventController::class, 'unPublish', User::ADMIN);
  Router::post('event/archive/{slug}', AdminEventController::class, 'archive', User::ADMIN);
  Router::post('event/activate/{slug}', AdminEventController::class, 'activate', User::ADMIN);
  Router::post('event/delete/{slug}', AdminEventController::class, 'destroy', User::ADMIN);
});
