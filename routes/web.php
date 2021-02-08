<?php

/**
 * @file
 * Web routes.
 */

declare(strict_types=1);

use Components\Route\RouterInterface;
use Domain\Admin\Accounts\Account\Controllers\AccountController;
use Domain\Admin\Accounts\User\Controllers\UserAccountControllerBase;
use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Authentication\Controllers\AuthenticationController;
use Domain\Admin\Cms\Structure\Controllers\StructureControllerBase;
use Domain\Admin\ContactForm\Controller\ContactFormController;
use Domain\Admin\Event\Controllers\EventController as AdminEventController;
use Domain\Admin\File\Controllers\UploadFileController;
use Domain\Admin\Menu\Controllers\MenuController;
use Domain\Admin\Pages\Controllers\PageController as AdminPageController;
use Domain\Admin\Reports\Controllers\ReportsController;
use Domain\Admin\Settings\Controllers\SettingsControllers;
use Domain\Contact\Controllers\ContactController;
use Domain\Event\Controllers\EventArchiveController;
use Domain\Event\Controllers\EventController;
use Domain\Pages\Controllers\PageController;
use Components\Route\Router;

// Index routes.
Router::get('', PageController::class,
    'index');
Router::get('index', PageController::class,
    'index');

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

// Contact routes.
Router::post('contact', ContactController::class,
    'send');

// Admin routes.
Router::prefix('admin')->group(static function () {
    // Authorization routes.
    Router::get('', AuthenticationController::class,
        'index');
    Router::post('login', AuthenticationController::class,
        'login');
    Router::get('logout', AuthenticationController::class,
        'logout', User::ADMIN);

    // System routes.
    Router::get('dashboard', StructureControllerBase::class,
        'index', User::ADMIN);
    Router::get('content', StructureControllerBase::class,
        'content', User::ADMIN);
    Router::get('structure', StructureControllerBase::class,
        'structure', User::ADMIN);
    Router::get('configuration', StructureControllerBase::class,
        'configuration', User::ADMIN);
    Router::get('reports', StructureControllerBase::class,
        'reports', User::DEVELOPER);

    // File routes.
    Router::prefix('upload')->group(static function () {
        Router::post('file', UploadFileController::class,
            'store', User::ADMIN);
        Router::post('thumbnail', UploadFileController::class,
            'thumbnail', User::ADMIN);
        Router::post('banner', UploadFileController::class,
            'banner', User::ADMIN);
    });

    // Content routes.
    Router::prefix('content')->group(static function () {
        // Pages routes.
        Router::prefix('pages')->group(static function () {
            Router::get('', AdminPageController::class,
                'index', User::ADMIN);
            Router::get('page/create', AdminPageController::class,
                'create', User::ADMIN);
            Router::post('page/create/store', AdminPageController::class,
                'store', User::ADMIN);
            Router::get('page/edit/{slug}', AdminPageController::class,
                'edit', User::ADMIN);
            Router::post('page/edit/{slug}/remove/banner', AdminPageController::class,
                'removeBanner', User::ADMIN);
            Router::post('page/edit/{slug}/remove/thumbnail', AdminPageController::class,
                'removeThumbnail', User::ADMIN);
            Router::post('page/edit/{slug}/store', AdminPageController::class,
                'update', User::ADMIN);
            Router::post('page/publish/{slug}', AdminPageController::class,
                'publish', User::ADMIN);
            Router::post('page/unpublish/{slug}', AdminPageController::class,
                'unPublish', User::ADMIN);
            Router::post('page/delete/{slug}', AdminPageController::class,
                'destroy', User::ADMIN);
        });

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

        // Contact form routes.
        Router::prefix('contact-form')->group(static function () {
            Router::get('', ContactFormController::class,
                'index', User::ADMIN);
            Router::get('filter', ContactFormController::class,
                'showByDate', User::ADMIN);
            Router::post('delete/{slug}', ContactFormController::class,
                'destroy', User::ADMIN);
        });
    });

    // Structure routes.
    Router::prefix('structure')->group(static function () {
        // Menu routes.
        Router::prefix('menu')->group(static function () {
            Router::get('', MenuController::class,
                'index', User::ADMIN);
            Router::get('item/create', MenuController::class,
                'create', User::ADMIN);
            Router::post('item/create/store', MenuController::class,
                'store', User::ADMIN);
            Router::get('item/edit/{slug}', MenuController::class,
                'edit', User::ADMIN);
            Router::post('item/edit/{slug}/update', MenuController::class,
                'update', User::ADMIN);
            Router::post('item/delete/{slug}', MenuController::class,
                'destroy', User::ADMIN);
        });
    });

    // Configuration routes.
    Router::prefix('configuration')->group(static function () {
        // Settings routes.
        Router::prefix('settings')->group(static function () {
            Router::get('', SettingsControllers::class,
                'index', User::ADMIN);
            Router::get('setting/create', SettingsControllers::class,
                'create', User::ADMIN);
            Router::post('setting/create/store', SettingsControllers::class,
                'store', User::ADMIN);
            Router::get('setting/edit/{slug}', SettingsControllers::class,
                'edit', User::ADMIN);
            Router::post('setting/edit/{slug}/update', SettingsControllers::class,
                'update', User::ADMIN);
            Router::post('setting/delete/{slug}', SettingsControllers::class,
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

    // Reports routes.
    Router::prefix('reports')->group(static function () {
        // Application routes.
        Router::get('application', ReportsController::class,
            'application', User::DEVELOPER);

        // Logs routes.
        Router::get('logs', ReportsController::class,
            'logs', User::DEVELOPER);

        // Storage routes.
        Router::get('storage', ReportsController::class,
            'storage', User::DEVELOPER);
    });
});

// Page not found route.
Router::get(RouterInterface::URL_PAGE_NOT_FOUND, PageController::class,
    'findOr404');
