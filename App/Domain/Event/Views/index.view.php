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
                            <a href="/concert/<?= $singleEventRepository->getSlug() ?>"
                                class="link-without-styling">
                                <img class="card-img-top"
                                     alt="<?= $singleEventRepository->getTitle() ?> thumbnail"
                                     src="<?= $singleEventRepository->getThumbnail() ?>"
                                >
                                <div class="card-body p-2">
                                    <h4 class="card-title p-0 m-0">
                                        <?= $singleEventRepository->getTitle() ?>
                                    </h4>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach;
            else : ?>
                <div class="col-md-12">
                    Er zijn momenteel geen komende concerten.
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
