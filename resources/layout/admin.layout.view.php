<?php

use App\System\Breadcrumbs\Breadcrumbs;
use Domain\Admin\Accounts\Account\Support\AccountRightsConverter;
use Domain\Admin\Accounts\User\Models\User;
use Src\Core\Request;
use Src\Core\URI;
use Src\Translation\Translation;
use Support\Resource;

$user = new User();
$rights = new AccountRightsConverter($user->getRights());
$request = new Request();
$breadcrumbs = new Breadcrumbs();
?>
<!DOCTYPE html>
<html lang="<?= Translation::DUTCH_LANGUAGE_CODE ?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title><?= $data['title'] ?? $request->env('app_name') ?></title>

    <!-- Fav icon -->
    <link rel="icon" type="image/png" sizes="96x96"
          href="/themes/cms_theme/src/images/favicon/favicon-96x96.png">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css"
          href="/themes/cms_theme/dist/css/toolkit.min.css">

    <?php if (!$user->isLoggedIn()) : ?>
        <!-- Login CSS -->
        <link rel="stylesheet" type="text/css"
              href="/themes/cms_theme/src/css/login.css">
    <?php endif; ?>
</head>
<body>
<?php if ($user->isLoggedIn()) : ?>
    <div class="wrapper">
        <div class="sidebar" data-color="orange"
             data-image="/themes/cms_theme/src/images/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <?php if ($user->getRights() >= User::ADMIN) : ?>
                        <li class="nav-item <?= strpos(URI::getUrl(),
                            'dashboard') !== false ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/dashboard">
                                <i class="fas fa-home"></i>
                                <p>
                                    <?= Translation::get('admin_menu_dashboard') ?>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item <?= strpos(URI::getUrl(),
                            'content') !== false ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/content">
                                <i class="far fa-file-alt"></i>
                                <p>
                                    <?= Translation::get('admin_content_title') ?>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item <?= strpos(URI::getUrl(),
                            'structure') !== false ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/structure">
                                <i class="fas fa-sitemap"></i>
                                <p>
                                    <?= Translation::get('admin_structure_title') ?>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item <?= strpos(URI::getUrl(),
                            'configuration') !== false ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/configuration">
                                <i class="fas fa-cogs"></i>
                                <p>
                                    <?= Translation::get('admin_configuration_title') ?>
                                </p>
                            </a>
                        </li>

                    <?php endif;
                    if ($user->getRights() >= User::SUPER_ADMIN) : ?>
                        <li class="nav-item <?= strpos(URI::getUrl(),
                            'account') !== false && strpos(URI::getUrl(),
                            'user') === false ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/account">
                                <i class="fas fa-users"></i>
                                <p>
                                    <?= Translation::get('admin_accounts_title') ?>
                                </p>
                            </a>
                        </li>
                    <?php endif;
                    if ($user->getRights() >= User::DEVELOPER) : ?>
                        <li class="nav-item <?= strpos(URI::getUrl(),
                            'reports') !== false ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/reports">
                                <i class="fas fa-chart-bar"></i>
                                <p>
                                    <?= Translation::get('admin_reports_title') ?>
                                </p>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-expand-lg ">
                <div class="container-fluid">
                    <p class="navbar-brand font-weight-bold">
                        <?= $data['title'] ?? '' ?>
                    </p>
                    <button class="navbar-toggler navbar-toggler-right mr-3"
                            type="button" data-toggle="collapse"
                            aria-controls="navigation-index"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end"
                         id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link color-default <?= strpos(URI::getUrl(),
                                    'user/account') !== false ? 'active-link' : '' ?>"
                                   href="/admin/user/account">
                                <span class="no-icon">
                                    <?= Translation::get('welcome_text') ?>
                                    <?= $user->getName() ?> -
                                    <b><?= $rights->toReadable() ?></b>
                                </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-default"
                                   href="/admin/logout">
                                    <span class="no-icon">
                                        <?= Translation::get('logout_button') ?>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="scrollbox-vertical">
                <div class="content">
                    <div class="container-fluid">
                        <?php Resource::loadFlashMessage(); ?>

                        <?php if ($breadcrumbs->visible()) : ?>
                            <div class="row breadcrumbs">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <?= $breadcrumbs->generate() ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?= $content ?? '' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="container-fluid">
        <?php Resource::loadFlashMessage(); ?>

        <?= $content ?? '' ?>
    </div>
<?php endif; ?>

<script src="/themes/cms_theme/dist/js/main.min.js"></script>
<script src="/themes/cms_theme/dist/js/fontawesome.min.js"></script>
<script src="/themes/cms_theme/dist/js/datatables.min.js"></script>
<script src="/themes/cms_theme/dist/js/datepicker.min.js"></script>
<script src="/themes/cms_theme/dist/js/clockpicker.min.js"></script>
<script src="/themes/cms_theme/dist/js/password-strength-indicator.min.js"></script>
<script src="/themes/cms_theme/dist/js/tinymce.min.js"></script>
<script src="/themes/cms_theme/dist/js/cropper.min.js"></script>
</body>
</html>
