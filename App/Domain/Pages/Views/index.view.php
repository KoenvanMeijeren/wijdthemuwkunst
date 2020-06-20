<?php
declare(strict_types=1);

use App\Domain\Admin\Event\Repositories\EventRepository;
use Domain\Admin\Pages\Repositories\PageRepository;
use Src\Core\Request;

$request = new Request();

$documentRoot = $request->server(Request::DOCUMENT_ROOT);

/** @var PageRepository $home */
$home = $homeRepo ?? null;
/** @var PageRepository $eventsRepository */
$eventsRepository = $eventsRepo ?? null;
?>

<?php if ($home->getBanner() !== ''
    && file_exists($documentRoot . $home->getBanner())
) : ?>
    <!-- Banner -->
    <section class="header">
        <img class="banner" src="<?= $home->getBanner() ?>"
             alt="<?= $home->getTitle() . ' image banner' ?>">
    </section>
<?php else : ?>
    <section class="header">
        <img class="banner" src="/themes/whuk_theme/src/images/banner.jpg"
             alt="<?= $home->getTitle() . ' image banner' ?>">
    </section>
<?php endif;
if ($home->getThumbnail() !== ''
    && file_exists($documentRoot . $home->getThumbnail())
) : ?>
    <!-- Thumbnail -->
    <section class="header">
        <img class="thumbnail" src="<?= $home->getThumbnail() ?>"
             alt="<?= $home->getTitle() . ' image banner' ?>">
    </section>
<?php endif; ?>

<div class="container page">
    <?php if ($home->getContent() !== '') : ?>
        <div class="mt-5 mb-5">
            <?= parseHtmlEntities($home->getContent()) ?>
        </div>
    <?php endif; ?>

    <?php if (isset($events) && !empty($events)) : ?>
        <div class="mt-5 mb-5">
            <div class="row">
                <div class="events-content">
                    <?= parseHtmlEntities($eventsRepository->getContent()) ?>
                </div>
            </div>

            <div class="row">
                <?php foreach ($events as $singleEvent) :
                    $event = new EventRepository($singleEvent);
                    ?>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="/concerten/concert/<?= $event->getSlug() ?>"
                               class="link-without-styling">
                                <img class="card-img-top"
                                     alt="<?= $event->getTitle() ?> thumbnail"
                                     src="<?= $event->getThumbnail() ?>"
                                >
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 class="card-title p-0 m-0">
                                                <?= $event->getTitle() ?>
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="card-title p-0 m-0">
                                                <?= $event->getDayNumber() ?>
                                                <?= $event->getShortDate() ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
