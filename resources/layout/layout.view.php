<?php

use App\Domain\Event\Models\Event;
use Domain\Admin\Pages\Models\Page as AdminPage;
use Domain\Admin\Pages\Repositories\PageRepository;
use Domain\Admin\Settings\Models\Setting;
use Domain\Pages\Models\Page;
use Src\Core\Request;
use Src\Security\CSRF;
use Src\Session\Session;
use Src\Translation\Translation;
use Support\Resource;

$setting = new Setting();
$session = new Session();
$request = new Request();
$page = new Page();
$event = new Event();
$pagesInMenu = $page->getByVisibility(AdminPage::PAGE_PUBLIC_IN_MENU);
?>
<!DOCTYPE html>
<html lang="<?= Translation::DUTCH_LANGUAGE_CODE ?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1"/>

    <!-- SEO -->
    <meta name="description" content="Christelijk koor Wijdt Hem Uw Kunst">
    <meta name="keywords" content="Christelijk koor, Harderwijk">
    <meta name="author" content="Christelijk koor Wijdt Hem Uw Kunst">

    <!-- Fav icon -->
    <link rel="icon" type="image/png" sizes="96x96"
          href="/images/favicon/favicon.ico">

    <!-- Bootstrap -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/ec953a682d.js"
            crossorigin="anonymous"></script>

    <!-- Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lato:300,400,700|Pacifico">

    <!-- Theme -->
    <link rel="stylesheet" href="/css/main.css"/>

    <!-- Recaptcha -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <title><?= $data['title'] ?? 'Undefined' ?></title>
</head>
<body>

<!-- Header -->
<header id="header">
    <div class="inner">
        <a href="/" class="logo">
            <?= $setting->get('website_naam') ?>
        </a>
        <nav id="nav">
            <a href="/">Home</a>

            <?php if (count($event->getLimited(1)) > 0) : ?>
                <a href="/concerten">Concerten</a>
            <?php endif; ?>

            <?php foreach ($pagesInMenu as $menuPage) :
                $pageRepository = new PageRepository($menuPage) ?>
                <a href="<?= $pageRepository->getSlug() ?>"><?= $pageRepository->getTitle() ?></a>
            <?php endforeach; ?>
        </nav>

        <a class="menu-toggle" href="#navPanel" aria-label="Toon menu"><span class="fa fa-bars"></span></a>
    </div>
</header>

<div class="page">
    <?= $content ?? '' ?>
</div>

<!-- Footer -->
<section id="footer">
    <div class="inner">
        <header>
            <h2>Neem contact op</h2>
        </header>
        <form id="form" method="post" action="/contact">
            <?php Resource::loadStringMessage(); ?>
            <?= CSRF::insertToken('/contact') ?>

            <div class="field half first">
                <label for="name">Naam</label>
                <input type="text" name="name" id="name"
                       value="<?= $session->get('name', true) ?>" required/>
            </div>
            <div class="field half">
                <label for="email">Email</label>
                <input type="text" name="email" id="email"
                       value="<?= $session->get('email', true) ?>" required/>
            </div>
            <div class="field">
                <label for="message">Bericht</label>
                <textarea name="message" id="message" rows="6"
                          required><?= $session->get('message', true) ?></textarea>
            </div>

            <ul class="actions">
                <li>
                    <button type="submit" class="button g-recaptcha"
                            data-sitekey="<?= $request->env('recaptcha_public_key') ?>"
                            data-callback="onSubmit">
                        Bericht verzenden
                    </button>
                </li>
            </ul>
        </form>
        <div class="copyright">
            <p>
                &copy; <?= $setting->get('copyright_tekst') ?>
            </p>
        </div>
    </div>
</section>

<!-- Jquery -->
<script type="text/javascript"
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

<!-- Bootstrap -->
<script type="text/javascript"
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!-- Site JS -->
<script type="text/javascript" src="/js/skel.min.js"></script>
<script type="text/javascript" src="/js/util.js"></script>
<script type="text/javascript" src="/js/main.js"></script>
</body>
</html>
