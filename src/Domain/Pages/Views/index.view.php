<?php

/**
 * @file
 */

declare(strict_types=1);

use Domain\Admin\Event\Repositories\EventRepository;
use Src\Core\Request;

$request = new Request();

$documentRoot = $request->server(Request::DOCUMENT_ROOT);

/**
 * @var \Domain\Admin\Pages\Repositories\PageRepository $home */
$home = $homeRepo ?? NULL;
/**
 * @var \Domain\Admin\Pages\Repositories\PageRepository $eventsRepository */
$eventsRepository = $eventsRepo ?? NULL;
?>

<?php if ($home->getBanner() !== ''
    && file_exists($documentRoot . $home->getBanner())
) : ?>
    <!-- Banner -->
    <section class="header">
        <img class="banner" src="<?php echo $home->getBanner() ?>"
             alt="<?php echo $home->getTitle() . ' image banner' ?>">
    </section>
<?php else : ?>
    <section class="header">
        <img class="banner" src="/themes/whuk_theme/src/images/banner.jpg"
             alt="<?php echo $home->getTitle() . ' image banner' ?>">
    </section>
<?php endif;
if ($home->getThumbnail() !== ''
    && file_exists($documentRoot . $home->getThumbnail())
) : ?>
    <!-- Thumbnail -->
    <section class="header">
        <img class="thumbnail" src="<?php echo $home->getThumbnail() ?>"
             alt="<?php echo $home->getTitle() . ' image banner' ?>">
    </section>
<?php endif; ?>

<div class="container page">
    <?php if ($home->getContent() !== '') : ?>
        <div class="mt-5 mb-5">
            <?php echo html_entities_decode($home->getContent()) ?>
        </div>
    <?php endif; ?>

    <?php if (isset($events) && !empty($events)) : ?>
        <div class="mt-5 mb-5">
            <div class="row">
                <div class="events-content">
                    <?php echo html_entities_decode($eventsRepository->getContent()) ?>
                </div>
            </div>

            <div class="row">
                <?php foreach ($events as $singleEvent) :
                  $event = new EventRepository($singleEvent);
                  ?>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="/concerten/concert/<?php echo $event->getSlug() ?>"
                               class="link-without-styling">
                                <img class="card-img-top"
                                     alt="<?php echo $event->getTitle() ?> thumbnail"
                                     src="<?php echo $event->getThumbnail() ?>"
                                >
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 class="card-title p-0 m-0">
                                                <?php echo $event->getTitle() ?>
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="card-title p-0 m-0">
                                                <?php echo $event->getDayNumber() ?>
                                                <?php echo $event->getShortDate() ?>
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
