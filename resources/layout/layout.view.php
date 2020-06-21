<?php

use Domain\Admin\Menu\Models\Menu;
use Domain\Admin\Menu\Repositories\MenuRepository;
use Domain\Admin\Settings\Models\Setting;
use Domain\Admin\Text\Models\Text;
use Domain\Event\Models\Event;
use Src\Core\Request;
use Src\Security\CSRF;
use Src\Session\Session;
use Src\Translation\Translation;
use Support\Resource;

$setting = new Setting();
$text = new Text();
$session = new Session();
$request = new Request();
$event = new Event();
$menu = new Menu();
$menuItems = $menu->getAll();
?>
<!DOCTYPE html>
<html lang="<?= Translation::DUTCH_LANGUAGE_CODE ?>">
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
            <?= $setting->get('website_naam') ?>
        </a>
        <?php if (count($menuItems) > 0) : ?>
            <nav id="nav">
                <?php foreach ($menuItems as $menuItem) :
                    $menu = new MenuRepository($menuItem);
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
            <h2>
                <?= $text->get(
                    'contact_formulier_titel',
                    'Neem contact op'
                ) ?>
            </h2>
        </header>
        <form id="form" method="post" action="/contact">
            <?php Resource::loadStringMessage(); ?>
            <?= CSRF::insertToken('/contact') ?>

            <div class="field half first">
                <label for="name">
                    <?= $text->get(
                        'contact_formulier_naam_veld',
                        'Naam'
                    ) ?>
                </label>
                <input type="text" name="name" id="name"
                       value="<?= $session->get('name', true) ?>" required/>
            </div>
            <div class="field half">
                <label for="email">
                    <?= $text->get(
                        'contact_formulier_email_veld',
                        'Email'
                    ) ?>
                </label>
                <input type="text" name="email" id="email"
                       value="<?= $session->get('email', true) ?>" required/>
            </div>
            <div class="field">
                <label for="message">
                    <?= $text->get(
                        'contact_formulier_bericht_veld',
                        'Bericht'
                    ) ?>
                </label>
                <textarea name="message" id="message" rows="6"
                          required><?= $session->get('message', true) ?></textarea>
            </div>

            <ul class="actions">
                <li>
                    <button type="submit" class="button g-recaptcha"
                            data-sitekey="<?= $request->env('recaptcha_public_key') ?>"
                            data-callback="onSubmit">
                        <?= $text->get(
                            'contact_formulier_verzenden_knop',
                            'Bericht verzenden'
                        ) ?>
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

<script type="text/javascript" src="/themes/whuk_theme/dist/js/main.min.js"></script>
<script type="text/javascript" src="/themes/whuk_theme/dist/js/fontawesome.min.js"></script>
</body>
</html>
