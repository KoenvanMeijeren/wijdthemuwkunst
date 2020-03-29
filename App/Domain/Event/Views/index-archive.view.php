<?php

use App\Domain\Admin\Event\Repositories\EventRepository;

/** @var EventRepository $eventRepository */
$eventRepository = $eventRepo ?? null;
?>

<div class="container page">
    <div class="mt-5 mb-5">
        <div class="events-content">
            <?= parseHtmlEntities($eventRepository->getContent()) ?>
        </div>

        <div class="row">
            <?php if (isset($events) && count($events) > 0) :
                foreach ($events as $singleEvent) :
                    $singleEventRepository = new EventRepository($singleEvent);
                    ?>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="/concert/historie/<?= $singleEventRepository->getSlug() ?>"
                                class="link-without-styling">
                                <img class="card-img-top"
                                     alt="<?= $singleEventRepository->getTitle() ?> thumbnail"
                                     src="<?= $singleEventRepository->getThumbnail() ?>"
                                >
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 class="card-title p-0 m-0">
                                                <?= $singleEventRepository->getTitle() ?>
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="card-title p-0 m-0">
                                                <?= $singleEventRepository->getDayNumber() ?>
                                                <?= $singleEventRepository->getShortDate() ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach;
            else : ?>
                <div class="col-md-12">
                    Er zijn momenteel geen gearchiveerde concerten.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>