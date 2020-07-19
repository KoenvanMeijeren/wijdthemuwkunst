<?php

/**
 * @file
 */

use Domain\Admin\Event\Repositories\EventRepository;

/**
 * @var \Domain\Admin\Event\Repositories\EventRepository $eventRepository */
$eventRepository = $eventRepo ?? NULL;
/**
 * @var \Domain\Admin\Event\Repositories\EventRepository $eventArchiveRepository */
$eventArchiveRepository = $eventArchiveRepo ?? NULL;
?>

<div class="container page">
    <div class="mt-5 mb-5">
        <div class="events-content">
            <?php echo html_entities_decode($eventRepository->getContent()) ?>
        </div>

        <div class="row">
            <?php if (isset($events) && count($events) > 0) :
              foreach ($events as $singleEvent) :
                $singleEventRepository = new EventRepository($singleEvent);
                ?>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="/concerten/concert/<?php echo $singleEventRepository->getSlug() ?>"
                               class="link-without-styling">
                                <img class="card-img-top"
                                     alt="<?php echo $singleEventRepository->getTitle() ?> thumbnail"
                                     src="<?php echo $singleEventRepository->getThumbnail() ?>"
                                >
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 class="card-title p-0 m-0">
                                                <?php echo $singleEventRepository->getTitle() ?>
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="card-title p-0 m-0">
                                                <?php echo $singleEventRepository->getDayNumber() ?>
                                                <?php echo $singleEventRepository->getShortDate() ?>
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
                  <?= t('No events were found.') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="row">
            <?php if (isset($event_archive) && count($event_archive) > 0) : ?>
                <div class="col-md-12 events-content">
                    <?php echo html_entities_decode($eventArchiveRepository->getContent()) ?>
                </div>

                <?php foreach ($event_archive as $singleEvent) :
                  $singleEventRepository = new EventRepository($singleEvent);
                  ?>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="/concerten/historie/concert/<?php echo $singleEventRepository->getSlug() ?>"
                               class="link-without-styling">
                                <img class="card-img-top"
                                     alt="<?php echo $singleEventRepository->getTitle() ?> thumbnail"
                                     src="<?php echo $singleEventRepository->getThumbnail() ?>"
                                >
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 class="card-title p-0 m-0">
                                                <?php echo $singleEventRepository->getTitle() ?>
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="card-title p-0 m-0">
                                                <?php echo $singleEventRepository->getDayNumber() ?>
                                                <?php echo $singleEventRepository->getShortDate() ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach;
            endif; ?>

            <?php if (isset($amount_of_events) && (int) $amount_of_events > 3) : ?>
                <div class="col-md-12 text-center">
                    <a class="button" href="/concerten/historie">
                      <?= t('View more') ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
