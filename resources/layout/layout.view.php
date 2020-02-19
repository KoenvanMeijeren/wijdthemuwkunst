<?php

use Domain\Admin\Settings\Models\Setting;
use Src\Translation\Translation;

$setting = new Setting();
?>
<!DOCTYPE html>
<html lang="<?= Translation::DUTCH_LANGUAGE_CODE ?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, user-scalable=no"/>

    <!-- SEO -->
    <meta name="description" content="Christelijk koor Wijdt Hem Uw Kunst">
    <meta name="keywords" content="Christelijk koor, Harderwijk">
    <meta name="author" content="Christelijk koor Wijdt Hem Uw Kunst">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/css/bootstrap.css">

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/ec953a682d.js"
            crossorigin="anonymous"></script>

    <!-- Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Lato:300,400,700|Pacifico">

    <!-- Theme -->
    <link rel="stylesheet" href="css/main.css"/>

    <title><?= $data['title'] ?? 'Undefined' ?></title>

    <link rel="icon" href="/images/logo.png">
</head>
<body>

<!-- Header -->
<header id="header">
    <div class="inner">
        <a href="/" class="logo">Wijdt Hem Uw Kunst</a>
        <nav id="nav">
            <a href="/">Home</a>
            <a href="/over-ons">Over ons</a>
            <a href="/koor">Het koor</a>
            <a href="/concerten">Concerten</a>

            <?php foreach ($data['inMenuPages'] as $menuPage) : ?>
                <a href="<?= $menuPage->slug_name ?? '' ?>"><?= $menuPage->page_title ?? '' ?></a>
            <?php endforeach; ?>
        </nav>

        <a href="#navPanel"><span class="fa fa-bars"></span></a>
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
        <form method="post" action="/contact">
            <?php \Support\Resource::loadStringMessage(); ?>
            <?= \Src\Security\CSRF::insertToken('/contact') ?>

            <div class="field half first">
                <label for="name">Naam</label>
                <input type="text" name="name" id="name" required/>
            </div>
            <div class="field half">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required/>
            </div>
            <div class="field">
                <label for="message">Bericht</label>
                <textarea name="message" id="message" rows="6" required></textarea>
            </div>
            <ul class="actions">
                <li><input type="submit" value="Bericht verzenden" class="alt"/>
                </li>
            </ul>
        </form>
        <div class="copyright">
            &copy; <?= $setting->get('copyright_tekst') ?>
        </div>
    </div>
</section>

<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

<!-- Bootstrap -->
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!-- Site JS -->
<script src="js/skel.min.js"></script>
<script src="js/util.js"></script>
<script src="js/main.js"></script>
</body>
</html>
