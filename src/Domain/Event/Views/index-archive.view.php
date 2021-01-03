<?php

/**
 * @file
 */

use Domain\Admin\Event\Repositories\EventRepository;
use Components\SuperGlobals\Url\Uri;
use System\Breadcrumbs\Breadcrumbs;

/**
 * @var \Domain\Admin\Event\Repositories\EventRepository $eventRepository */
$eventRepository = $eventRepo ?? NULL;
$breadcrumbs = new Breadcrumbs(Uri::getUrl());
?>

<div class="container page">
    <div class="mt-5 mb-5">
        <?php if ($breadcrumbs->visible()) : ?>
            <div class="row breadcrumbs">
                <div class="col-sm-12">
                    <?php echo $breadcrumbs->generate() ?>
                </div>
            </div>
        <?php endif; ?>

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
            else : ?>
                <div class="col-md-12">
                  <?= t('Er zijn geen gearchiveerde concerten gevonden.') ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
