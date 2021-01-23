<?php

use Components\SuperGlobals\Url\Uri;
use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\Account\Support\AccountRightsConverter;
use Domain\Admin\Accounts\User\Models\User;
use Support\Resource;
use System\Breadcrumbs\Breadcrumbs;
use System\Request;

$user = new User();
$rights = new AccountRightsConverter($user->getRights());
$request = new Request();
$breadcrumbs = new Breadcrumbs(Uri::getUrl());
?>
<!DOCTYPE html>
<html lang="<?= TranslationOld::DUTCH_LANGUAGE_CODE ?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title><?= $data['title'] ?? $request->env('app_name') ?></title>

    <!-- Fav icon -->
    <link rel="icon" type="image/png" sizes="96x96"
          href="/themes/cms_theme/img/favicon/favicon-96x96.png">

    <!-- Custom fonts for this template-->
    <link href="/themes/cms_theme/vendor/fontawesome-free/css/all.min.css"
          rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="/themes/cms_theme/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="/themes/cms_theme/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="/themes/cms_theme/vendor/cropperjs/cropper.min.css" rel="stylesheet">
    <link href="/themes/cms_theme/vendor/datepicker/datepicker.min.css" rel="stylesheet">
    <link href="/themes/cms_theme/vendor/clockpicker/bootstrap-clockpicker.min.css" rel="stylesheet">
    <link href="/themes/cms_theme/vendor/password-strength-meter/password.min.css" rel="stylesheet">

    <!-- Tiny MCE -->
    <script src="https://cdn.tiny.cloud/1/<?= $request->env('tiny_mce_key') ?>/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>
<body id="page-top">
<div id="wrapper">
    <?php if ($user->isLoggedIn()) : ?>
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion toggled"
            id="accordionSidebar">

            <li>
                <a class="sidebar-brand d-flex align-items-center justify-content-center"
                   href="/admin">
                    <div class="sidebar-brand-icon">
                        <i class="fas fa-cross"></i>
                    </div>
                    <div class="sidebar-brand-text mx-3">
                        Admin panel
                    </div>
                </a>

                <hr class="sidebar-divider my-0">
            </li>

            <?php if ($user->getRights() >= User::ADMIN) : ?>
                <li class="nav-item <?= strpos(Uri::getUrl(),
                    'dashboard') !== false ? 'active' : '' ?>">
                    <a class="nav-link" href="/admin/dashboard">
                        <i class="fas fa-home"></i>
                        <span>
                            <?= TranslationOld::get('admin_menu_dashboard') ?>
                        </span>
                    </a>
                </li>
                <li class="nav-item <?= strpos(Uri::getUrl(),
                    'content') !== false ? 'active' : '' ?>">
                    <a class="nav-link collapsed" href="#"
                       data-toggle="collapse"
                       data-target="#siteContent" aria-expanded="true"
                       aria-controls="collapseTwo">
                        <i class="fas fa-file-alt"></i>
                        <span class="pl-1"> <?= TranslationOld::get('admin_content_title') ?></span>
                    </a>
                    <div id="siteContent" class="collapse"
                         aria-labelledby="siteContent"
                         data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <?php $menuItems = $data['menuItems']['content'] ?? [];
                            foreach ($menuItems as $title => $item) : ?>
                                <a class="collapse-item"
                                   href="<?= $item['link'] ?? '#' ?>">
                                    <?= $item['title'] ?? '' ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </li>
                <li class="nav-item <?= strpos(Uri::getUrl(),
                    'structure') !== false ? 'active' : '' ?>">
                    <a class="nav-link collapsed" href="#"
                       data-toggle="collapse"
                       data-target="#structure" aria-expanded="true"
                       aria-controls="collapseTwo">
                        <i class="fas fa-sitemap"></i>
                        <span> <?= TranslationOld::get('admin_structure_title') ?></span>
                    </a>
                    <div id="structure" class="collapse"
                         aria-labelledby="structure"
                         data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <?php $menuItems = $data['menuItems']['structure'] ?? [];
                            foreach ($menuItems as $title => $item) : ?>
                                <a class="collapse-item"
                                   href="<?= $item['link'] ?? '#' ?>">
                                    <?= $item['title'] ?? '' ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </li>
                <li class="nav-item <?= strpos(Uri::getUrl(),
                    'configuration') !== false ? 'active' : '' ?>">
                    <a class="nav-link collapsed" href="#"
                       data-toggle="collapse"
                       data-target="#configuration" aria-expanded="true"
                       aria-controls="collapseTwo">
                        <i class="fas fa-cogs"></i>
                        <span> <?= TranslationOld::get('admin_configuration_title') ?></span>
                    </a>
                    <div id="configuration" class="collapse"
                         aria-labelledby="configuration"
                         data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <?php $menuItems = $data['menuItems']['configuration'] ?? [];
                            foreach ($menuItems as $title => $item) : ?>
                                <a class="collapse-item"
                                   href="<?= $item['link'] ?? '#' ?>">
                                    <?= $item['title'] ?? '' ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </li>

            <?php endif;
            if ($user->getRights() >= User::SUPER_ADMIN) : ?>
                <li class="nav-item <?= strpos(Uri::getUrl(),
                    'account') !== false && strpos(Uri::getUrl(),
                    'user') === false ? 'active' : '' ?>">
                    <a class="nav-link" href="/admin/account">
                        <i class="fas fa-users"></i>
                        <span>
                            <?= TranslationOld::get('admin_accounts_title') ?>
                        </span>
                    </a>
                </li>
            <?php endif;
            if ($user->getRights() >= User::DEVELOPER) : ?>
                <li class="nav-item <?= strpos(Uri::getUrl(),
                    'reports') !== false ? 'active' : '' ?>">
                    <a class="nav-link collapsed" href="#"
                       data-toggle="collapse"
                       data-target="#reports" aria-expanded="true"
                       aria-controls="collapseTwo">
                        <i class="fas fa-chart-bar"></i>
                        <span> <?= TranslationOld::get('admin_reports_title') ?></span>
                    </a>
                    <div id="reports" class="collapse"
                         aria-labelledby="reports"
                         data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <?php $menuItems = $data['menuItems']['reports'] ?? [];
                            foreach ($menuItems as $title => $item) : ?>
                                <a class="collapse-item"
                                   href="<?= $item['link'] ?? '#' ?>">
                                    <?= $item['title'] ?? '' ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0"
                        id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav
                    class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop"
                            class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <ul class="navbar-nav">
                        <li class="nav-item h3">
                            <?= $data['title'] ?? '' ?>
                        </li>
                    </ul>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto navbar-desktop">
                        <li class="nav-item">
                            <a class="nav-link <?= strpos(Uri::getUrl(),
                                'user/account') !== false ? 'active-link' : '' ?>"
                               href="/admin/user/account">
                                <?= TranslationOld::get('welcome_text') ?>
                                <?= $user->getName() ?> -
                                <b><?= $rights->toReadable() ?></b>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link"
                               href="/admin/logout">
                                <?= TranslationOld::get('logout_button') ?>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <?php Resource::loadFlashMessage(); ?>

                    <?php if ($breadcrumbs->visible(2)) {
                        echo $breadcrumbs->generate();
                    } ?>

                    <?= $content ?? '' ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    <?php else : ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Begin Page Content -->
                <div class="container">
                    <?php Resource::loadFlashMessage(); ?>

                    <?= $content ?? '' ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    <?php endif; ?>
</div>

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="/themes/cms_theme/vendor/jquery/jquery.min.js"></script>
<script src="/themes/cms_theme/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="/themes/cms_theme/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="/themes/cms_theme/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/themes/cms_theme/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="/themes/cms_theme/vendor/cropperjs/cropper.min.js"></script>
<script src="/themes/cms_theme/vendor/datepicker/datepicker.min.js"></script>
<script src="/themes/cms_theme/vendor/clockpicker/bootstrap-clockpicker.min.js"></script>
<script src="/themes/cms_theme/vendor/password-strength-meter/password.min.js"></script>
<script src="/themes/cms_theme/vendor/bootstrap-notify/bootstrap-notify.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="/themes/cms_theme/js/sb-admin-2.min.js"></script>
<script src="/themes/cms_theme/js/datatables.min.js"></script>
<script src="/themes/cms_theme/js/cropper.min.js"></script>
<script src="/themes/cms_theme/js/tinymce.min.js"></script>
</body>
</html>
