<?php

use Src\Translation\Translation;

?>
<!DOCTYPE html>
<html lang="<?= Translation::DUTCH_LANGUAGE_CODE ?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- SEO -->
    <meta name="description" content="Christelijk koor Wijdt Hem Uw Kunst">
    <meta name="keywords" content="Christelijk koor, Harderwijk">
    <meta name="author" content="Christelijk koor Wijdt Hem Uw Kunst">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Satisfy&display=swap"
          rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/ec953a682d.js"
            crossorigin="anonymous"></script>

    <!-- Theme -->
    <link rel="stylesheet" href="/css/theme.css">

    <title><?= $data['title'] ?? 'Undefined' ?></title>

    <link rel="icon" href="/images/logo.png">
</head>
<body>
<nav class="navbar navbar-expand-lg m-0 p-0">
    <div class="container">
        <div class="d-flex flex-grow-1">
            <a class="navbar-brand logo" href="/">
<!--                <img src="/web/assets/images/logo.png"-->
<!--                     alt="Wijdt Hem uw kunst logo" width="100%">-->
                <h1 class="m-2">
                    Christelijk koor <br>
                    Wijdt Hem Uw Kunst
                </h1>
            </a>

            <button class="navbar-toggler button-unstyled"
                    type="button" id="nav-icon"
                    data-toggle="collapse" data-target="#navbar"
                    aria-controls="navbar" aria-expanded="false"
                    aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <div class="collapse navbar-collapse flex-grow-1" id="navbar">
            <ul class="navbar-nav ml-3">
                <li class="nav-item active">
                    <a class="nav-link active" href="#home">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#over-ons">
                        Over ons
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#koor">
                        Het koor
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#concerten">
                        Concerten
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?= $content ?? '' ?>

<footer class="page-footer font-small bg-light pt-4">
    <div class="container page text-center text-md-left">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-2 mb-3">
                <h5 class="font-beyond">Sociale media</h5>

                <ul class="list-unstyled">
                    <li>
                        <i class="fab fa-facebook"></i>
                        <a href="#facebook">
                            Facebook
                        </a>
                    </li>
                    <li>
                        <i class="fab fa-instagram"></i>
                        <a href="#instagram">
                            Instagram
                        </a>
                    </li>
                    <li>
                        <i class="fab fa-youtube"></i>
                        <a href="#youtube">
                            Youtube
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col-sm-3 mb-3">
                <h5 class="font-beyond">Secretariaat</h5>

                <ul class="list-unstyled">
                    <li>
                        <i class="far fa-envelope"></i>
                        Postbus 3, 3456 AB Harderwijk
                    </li>
                    <li>
                        <i class="fas fa-envelope"></i>
                        info@wijdthemuwkunst.nl
                    </li>
                    <li>
                        <i class="fas fa-phone"></i>
                        (0341) 123456
                    </li>
                </ul>
            </div>

            <div class="col-sm-2 mb-3">
                <h5 class="font-beyond">Informatie</h5>

                <ul class="list-unstyled">
                    <li>
                        <i class="fas fa-euro-sign"></i>
                        IBAN:
                    </li>
                    <li>
                        <i class="fas fa-building"></i>
                        Kvk:
                    </li>
                </ul>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>

    <div class="footer-copyright text-center py-3">
        © 2019 Copyright: Wijdt Hem uw kunst
    </div>

    <!-- Jquery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

    <!-- Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Site JS -->
    <script src="/js/default.js"></script>
</footer>
</body>
</html>
