<?php

/**
 * @file
 * Web routes.
 */

declare(strict_types=1);

use Domain\Admin\Accounts\Account\Controllers\AccountController;
use Domain\Admin\Accounts\User\Controllers\UserAccountControllerBase;
use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Authentication\Controllers\AuthenticationController;
use Domain\Admin\Event\Controllers\EventController as AdminEventController;
use Domain\Event\Controllers\EventArchiveController;
use Domain\Event\Controllers\EventController;
use Components\Route\Router;

// Event routes.
Router::get('concerten', EventController::class,
    'index');
Router::get('concerten/concert/{slug}', EventController::class,
    'show');

// Event history routes.
Router::get('concerten/historie', EventArchiveController::class,
    'index');
Router::get('concerten/historie/concert/{slug}', EventArchiveController::class,
    'show');

// Admin routes.
Router::prefix('admin')->group(static function () {
    // Authorization routes.
    Router::get('', AuthenticationController::class,
        'index');
    Router::post('login', AuthenticationController::class,
        'login');
    Router::get('logout', AuthenticationController::class,
        'logout', User::ADMIN);

    // Content routes.
    Router::prefix('content')->group(static function () {
        // Events routes.
        Router::prefix('events')->group(static function () {
            Router::get('', AdminEventController::class,
                'index', User::ADMIN);
            Router::get('event/create', AdminEventController::class,
                'create', User::ADMIN);
            Router::post('event/create/store', AdminEventController::class,
                'store', User::ADMIN);
            Router::get('event/edit/{slug}', AdminEventController::class,
                'edit', User::ADMIN);
            Router::post('event/edit/{slug}/remove/banner', AdminEventController::class,
                'removeBanner', User::ADMIN);
            Router::post('event/edit/{slug}/remove/thumbnail', AdminEventController::class,
                'removeThumbnail', User::ADMIN);
            Router::post('event/edit/{slug}/store', AdminEventController::class,
                'update', User::ADMIN);
            Router::post('event/publish/{slug}', AdminEventController::class,
                'publish', User::ADMIN);
            Router::post('event/unpublish/{slug}', AdminEventController::class,
                'unPublish', User::ADMIN);
            Router::post('event/archive/{slug}', AdminEventController::class,
                'archive', User::ADMIN);
            Router::post('event/activate/{slug}', AdminEventController::class,
                'activate', User::ADMIN);
            Router::post('event/delete/{slug}', AdminEventController::class,
                'destroy', User::ADMIN);
        });
    });

    // Account routes.
    Router::prefix('account')->group(static function () {
        Router::get('', AccountController::class,
            'index', User::SUPER_ADMIN);
        Router::get('create', AccountController::class,
            'create', User::SUPER_ADMIN);
        Router::post('create/store', AccountController::class,
            'store', User::SUPER_ADMIN);
        Router::get('edit/{slug}', AccountController::class,
            'edit', User::SUPER_ADMIN);
        Router::post('edit/{slug}/store/data', AccountController::class,
            'storeData', User::SUPER_ADMIN);
        Router::post('edit/{slug}/store/email', AccountController::class,
            'storeEmail', User::SUPER_ADMIN);
        Router::post('edit/{slug}/store/password', AccountController::class,
            'storePassword', User::SUPER_ADMIN);
        Router::post('block/{slug}', AccountController::class,
            'block', User::SUPER_ADMIN);
        Router::post('unblock/{slug}', AccountController::class,
            'unblock', User::SUPER_ADMIN);
        Router::post('delete/{slug}', AccountController::class,
            'destroy', User::SUPER_ADMIN);
    });

    // User account routes.
    Router::prefix('user/account')->group(static function () {
        Router::get('', UserAccountControllerBase::class,
            'index', User::ADMIN);
        Router::post('store/data', UserAccountControllerBase::class,
            'storeData', User::ADMIN);
        Router::post('store/password', UserAccountControllerBase::class,
            'storePassword', User::ADMIN);
    });

});
