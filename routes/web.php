<?php

/**
 * @file
 * Web routes.
 */

declare(strict_types=1);

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
