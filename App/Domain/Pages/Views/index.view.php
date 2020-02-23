<?php
declare(strict_types=1);

use Domain\Admin\Pages\Repositories\PageRepository;

/** @var PageRepository $home */
$home = $homeRepo ?? null;
/** @var PageRepository $events */
$events = $eventsRepo ?? null;
?>

<?php if ($home->getBanner() !== ''
    && $home->getThumbnail() !== ''
    && file_exists($home->getBanner())
    && file_exists($home->getThumbnail())
) : ?>
    <!-- Banner -->
    <section class="header">
        <img class="banner" src="<?= $home->getBanner() ?>"
             alt="<?= $home->getTitle() . ' image banner' ?>">

        <img class="thumbnail" src="<?= $home->getThumbnail() ?>"
             alt="<?= $home->getTitle() . ' image banner' ?>">
    </section>
<?php else : ?>
    <section class="header">
        <img class="banner" src="/images/banner.jpg"
             alt="<?= $home->getTitle() . ' image banner' ?>">
    </section>
<?php endif; ?>

<div class="container page">
    <?php if ($home->getContent() !== '') : ?>
        <div class="mt-5 mb-5">
            <?= parseHtmlEntities($home->getContent()) ?>
        </div>
    <?php endif; ?>

    <div class="mt-5 mb-5">
        <div class="events-content">
            <?= parseHtmlEntities($events->getContent()) ?>
        </div>

        <div class="row">
            <?php for ($x = 0; $x < 6; $x++) : ?>
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="/images/kerk.jfif"
                             alt="Card image cap">
                        <div class="card-body p-2">
                            <h4 class="card-title p-0 m-0">Paas
                                uitvoering</h4>
                        </div>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
</div>
