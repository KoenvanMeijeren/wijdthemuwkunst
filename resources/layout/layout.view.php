<?php

use Components\Resource\Resource;
use Components\Security\CSRF;
use Components\Translation\TranslationOld;

?>
<!DOCTYPE html>
<html lang="<?= TranslationOld::DUTCH_LANGUAGE_CODE ?>">
<head>
    <title><?= $data['title'] ?? 'Undefined' ?></title>

    <link rel="icon" type="image/png" sizes="96x96" href="/themes/whuk_theme/src/images/favicon/favicon.ico">

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="description" content="Christelijk koor Wijdt Hem Uw Kunst">
    <meta name="keywords" content="Christelijk koor, Harderwijk">
    <meta name="author" content="Christelijk koor Wijdt Hem Uw Kunst">

    <link rel="stylesheet" href="/themes/whuk_theme/dist/css/toolkit.min.css"/>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<header id="header">
    <div class="inner">
        <a href="/" class="logo">
            <?= setting('website_naam') ?>
        </a>
        <?php if (isset($data['menuItems']) && count($data['menuItems']) > 0) : ?>
            <nav id="nav">
                <?php /** @var \Modules\Menu\Entity\MenuInterface $menu */
                foreach ($data['menuItems'] as $menu) :
                    if ($menu->getSlug() === 'index') : ?>
                        <a href="/"><?= $menu->getTitle() ?></a>
                    <?php else : ?>
                        <a href="<?= $menu->getSlug() ?>"><?= $menu->getTitle() ?></a>
                    <?php endif;
                endforeach; ?>
            </nav>

            <a class="menu-toggle" href="#navPanel" aria-label="Toon menu">
                <span class="fa fa-bars"></span>
            </a>
        <?php endif; ?>
    </div>
</header>

<div class="page">
    <?= $content ?? '' ?>
</div>

<section id="footer">
    <div class="inner">
        <header>
            <h2><?= t('Please contact us') ?></h2>
        </header>
        <form id="form" method="POST" action="/contact">
            <?php Resource::loadStringMessage(); ?>
            <?= CSRF::insertToken('/contact') ?>

            <div class="field half first">
                <label for="name"><?= t('Name') ?></label>
                <input type="text" name="name" id="name" value="<?= session()->get('name', unset: true) ?>" required/>
            </div>
            <div class="field half">
                <label for="email"><?= t('Email') ?></label>
                <input type="text" name="email" id="email" value="<?= session()->get('email', unset: true) ?>" required/>
            </div>
            <div class="field">
                <label for="message"><?= t('Message') ?></label>
                <textarea name="message" id="message" rows="6" required><?= session()->get('message', unset: true) ?></textarea>
            </div>

            <ul class="actions">
                <li>
                    <button type="submit" class="button g-recaptcha" data-sitekey="<?= request()->env('recaptcha_public_key') ?>" data-callback="onSubmit">
                      <?= t('Send message') ?>
                    </button>
                </li>
            </ul>
        </form>
        <div class="copyright">
            <p>&copy; <?= setting('copyright_tekst') ?></p>
        </div>
    </div>
</section>

<script type="text/javascript" src="/themes/whuk_theme/dist/js/main.min.js"></script>
<script type="text/javascript" src="/themes/whuk_theme/dist/js/fontawesome.min.js"></script>
</body>
</html>
