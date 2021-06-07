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
use Components\Route\Router;

// Admin routes.
Router::prefix('admin')->group(static function () {
    // Authorization routes.
    Router::get('', AuthenticationController::class,
        'index');
    Router::post('login', AuthenticationController::class,
        'login');
    Router::get('logout', AuthenticationController::class,
        'logout', User::ADMIN);

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
