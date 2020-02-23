<?php
declare(strict_types=1);

use Domain\Admin\Pages\Repositories\PageRepository;

/** @var PageRepository $page */
$page = $home ?? null;
?>

<?php if ($page->getBanner() !== '') : ?>
    <!-- Banner -->
    <section class="header">
        <img class="banner" src="<?= $page->getBanner() ?>"
             alt="<?= $page->getTitle() . ' image banner' ?>">

        <img class="thumbnail" src="<?= $page->getThumbnail() ?>"
             alt="<?= $page->getTitle() . ' image banner' ?>">
    </section>
<?php else : ?>
    <section class="header">
        <img class="banner" src="/images/banner.jpg" alt="<?= $page->getTitle() . ' image banner' ?>">
    </section>
<?php endif; ?>

<!-- About us -->
<?php if ($page->getContent() !== '') : ?>
    <section class="text-section pb-0" id="over-ons">
        <div class="inner">
            <div class="page-content">
                <?= parseHtmlEntities($page->getContent()) ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="text-section" id="concerten">
    <div class="inner">
        <header>
            <h2>Concerten</h2>
        </header>
        <p>
            Concerten tekst
        </p>

        <div class="row">
            <?php for ($x = 0; $x < 6; $x++) : ?>
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="/images/kerk.jfif"
                             alt="Card image cap">
                        <div class="card-body p-2">
                            <h4 class="card-title p-0 m-0">Paas uitvoering</h4>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</section>
