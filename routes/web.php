<?php
declare(strict_types=1);

use App\Domain\Admin\Cms\Structure\Controllers\StructureController;
use App\Domain\Admin\ContactForm\Controller\ContactFormController;
use App\Domain\Admin\Menu\Controllers\MenuController;
use App\Domain\Admin\Text\Controllers\TextController;
use App\Domain\Contact\Controllers\ContactController;
use App\Domain\Event\Controllers\EventArchiveController;
use App\Domain\Event\Controllers\EventController;
use Domain\Admin\Accounts\Account\Controllers\AccountController;
use Domain\Admin\Accounts\User\Controllers\UserAccountController;
use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Authentication\Controllers\AuthenticationController;
use Domain\Admin\Event\Controllers\EventController as AdminEventController;
use Domain\Admin\File\Controllers\UploadFileController;
use Domain\Admin\Pages\Controllers\PageController as AdminPageController;
use Domain\Admin\Reports\Controllers\ReportsController;
use Domain\Admin\Settings\Controllers\SettingsControllers;
use Domain\Pages\Controllers\PageController;
use Src\Core\Router;

/**
 * Index routes.
 */
Router::get('', PageController::class,
    'index', User::GUEST);
Router::get('index', PageController::class,
    'index', User::GUEST);

/**
 * Event routes.
 */
Router::get('concerten', EventController::class,
    'index', User::GUEST);
Router::get('concert/{slug}', EventController::class,
    'show', User::GUEST);

/**
 * Event history routes.
 */
Router::get('concerten-historie', EventArchiveController::class,
    'index', User::GUEST);
Router::get('concert/historie/{slug}', EventArchiveController::class,
    'show', User::GUEST);

/**
 * Contact routes.
 */
Router::post('contact', ContactController::class,
    'send', User::GUEST);

/**
 * Admin routes.
 */
Router::prefix('admin')->group(static function () {
    /**
     * Authorization routes.
     */
    Router::get('', AuthenticationController::class,
        'index', User::GUEST);
    Router::post('login', AuthenticationController::class,
        'login', User::GUEST);
    Router::get('logout', AuthenticationController::class,
        'logout', User::ADMIN);

    /**
     * System routes.
     */
    Router::get('dashboard', StructureController::class,
        'index', User::ADMIN);
    Router::get('content', StructureController::class,
        'content', User::ADMIN);
    Router::get('structure', StructureController::class,
        'structure', User::ADMIN);
    Router::get('configuration', StructureController::class,
        'configuration', User::ADMIN);
    Router::get('reports', StructureController::class,
        'reports', User::DEVELOPER);

    /**
     * Pages routes.
     */
    Router::get('content/pages', AdminPageController::class,
        'index', User::ADMIN);
    Router::get('content/pages/page/create', AdminPageController::class,
        'create', User::ADMIN);
    Router::post('content/pages/page/create/store', AdminPageController::class,
        'store', User::ADMIN);
    Router::get('content/pages/page/edit/{slug}', AdminPageController::class,
        'edit', User::ADMIN);
    Router::post('content/pages/page/edit/{slug}/remove/banner', AdminPageController::class,
        'removeBanner', User::ADMIN);
    Router::post('content/pages/page/edit/{slug}/remove/thumbnail', AdminPageController::class,
        'removeThumbnail', User::ADMIN);
    Router::post('content/pages/page/edit/{slug}/store', AdminPageController::class,
        'update', User::ADMIN);
    Router::post('content/pages/page/publish/{slug}', AdminPageController::class,
        'publish', User::ADMIN);
    Router::post('content/pages/page/unpublish/{slug}', AdminPageController::class,
        'unPublish', User::ADMIN);
    Router::post('content/pages/page/delete/{slug}', AdminPageController::class,
        'destroy', User::ADMIN);

    /**
     * Events routes.
     */
    Router::get('content/events', AdminEventController::class,
        'index', User::ADMIN);
    Router::get('content/events/event/create', AdminEventController::class,
        'create', User::ADMIN);
    Router::post('content/events/event/create/store', AdminEventController::class,
        'store', User::ADMIN);
    Router::get('content/events/event/edit/{slug}', AdminEventController::class,
        'edit', User::ADMIN);
    Router::post('content/events/event/edit/{slug}/remove/banner', AdminEventController::class,
        'removeBanner', User::ADMIN);
    Router::post('content/events/event/edit/{slug}/remove/thumbnail', AdminEventController::class,
        'removeThumbnail', User::ADMIN);
    Router::post('content/events/event/edit/{slug}/store', AdminEventController::class,
        'update', User::ADMIN);
    Router::post('content/events/event/publish/{slug}', AdminEventController::class,
        'publish', User::ADMIN);
    Router::post('content/events/event/unpublish/{slug}', AdminEventController::class,
        'unPublish', User::ADMIN);
    Router::post('content/events/event/archive/{slug}', AdminEventController::class,
        'archive', User::ADMIN);
    Router::post('content/events/event/activate/{slug}', AdminEventController::class,
        'activate', User::ADMIN);
    Router::post('content/events/event/delete/{slug}', AdminEventController::class,
        'destroy', User::ADMIN);

    /**
     * File upload routes.
     */
    Router::post('upload/file', UploadFileController::class,
        'store', User::ADMIN);
    Router::post('upload/thumbnail', UploadFileController::class,
        'thumbnail', User::ADMIN);
    Router::post('upload/banner', UploadFileController::class,
        'banner', User::ADMIN);

    /**
     * Contact form routes.
     */
    Router::get('content/contact-form', ContactFormController::class,
        'index', User::ADMIN);
    Router::get('content/contact-form/filter', ContactFormController::class,
        'showByDate', User::ADMIN);
    Router::post('content/contact-form/delete/{slug}', ContactFormController::class,
        'destroy', User::ADMIN);

    /**
     * Settings routes.
     */
    Router::get('configuration/settings', SettingsControllers::class,
        'index', User::ADMIN);
    Router::get('configuration/settings/setting/create', SettingsControllers::class,
        'create', User::ADMIN);
    Router::post('configuration/settings/setting/create/store', SettingsControllers::class,
        'store', User::ADMIN);
    Router::get('configuration/settings/setting/edit/{slug}', SettingsControllers::class,
        'edit', User::ADMIN);
    Router::post('configuration/settings/setting/edit/{slug}/update', SettingsControllers::class,
        'update', User::ADMIN);
    Router::post('configuration/settings/setting/delete/{slug}', SettingsControllers::class,
        'destroy', User::ADMIN);

    /**
     * Texts routes.
     */
    Router::get('configuration/texts', TextController::class,
        'index', User::ADMIN);
    Router::get('configuration/texts/text/create', TextController::class,
        'create', User::ADMIN);
    Router::post('configuration/texts/text/create/store', TextController::class,
        'store', User::ADMIN);
    Router::get('configuration/texts/text/edit/{slug}', TextController::class,
        'edit', User::ADMIN);
    Router::post('configuration/texts/text/edit/{slug}/update', TextController::class,
        'update', User::ADMIN);
    Router::post('configuration/texts/text/delete/{slug}', TextController::class,
        'destroy', User::ADMIN);

    /**
     * Menu routes.
     */
    Router::get('structure/menu', MenuController::class,
        'index', User::ADMIN);
    Router::get('structure/menu/item/create', MenuController::class,
        'create', User::ADMIN);
    Router::post('structure/menu/item/create/store', MenuController::class,
        'store', User::ADMIN);
    Router::get('structure/menu/item/edit/{slug}', MenuController::class,
        'edit', User::ADMIN);
    Router::post('structure/menu/item/edit/{slug}/update', MenuController::class,
        'update', User::ADMIN);
    Router::post('structure/menu/item/delete/{slug}', MenuController::class,
        'destroy', User::ADMIN);

    /**
     * Account routes.
     */
    Router::get('account', AccountController::class,
        'index', User::SUPER_ADMIN);
    Router::get('account/create', AccountController::class,
        'create', User::SUPER_ADMIN);
    Router::post('account/create/store', AccountController::class,
        'store', User::SUPER_ADMIN);
    Router::get('account/edit/{slug}', AccountController::class,
        'edit', User::SUPER_ADMIN);
    Router::post('account/edit/{slug}/store/data', AccountController::class,
        'storeData', User::SUPER_ADMIN);
    Router::post('account/edit/{slug}/store/email', AccountController::class,
        'storeEmail', User::SUPER_ADMIN);
    Router::post('account/edit/{slug}/store/password', AccountController::class,
        'storePassword', User::SUPER_ADMIN);
    Router::post('account/block/{slug}', AccountController::class,
        'block', User::SUPER_ADMIN);
    Router::post('account/unblock/{slug}', AccountController::class,
        'unblock', User::SUPER_ADMIN);
    Router::post('account/delete/{slug}', AccountController::class,
        'destroy', User::SUPER_ADMIN);

    /**
     * Debug routes.
     */
    Router::get('reports/application', ReportsController::class,
        'application', User::DEVELOPER);
    Router::get('reports/logs', ReportsController::class,
        'logs', User::DEVELOPER);
    Router::get('reports/storage', ReportsController::class,
        'storage', User::DEVELOPER);

    /**
     * User routes.
     */
    Router::get('user/account', UserAccountController::class,
        'index', User::ADMIN);
    Router::post('user/account/store/data',
        UserAccountController::class,
        'storeData', User::ADMIN);
    Router::post('user/account/store/password',
        UserAccountController::class,
        'storePassword', User::ADMIN);
});

/**
 * Page not found route.
 */
Router::get('pageNotFound', PageController::class,
    'findOr404', User::GUEST);
