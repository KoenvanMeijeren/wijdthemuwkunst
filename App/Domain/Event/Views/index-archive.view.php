<?php

/**
 * @file
 */

use App\Domain\Admin\Event\Repositories\EventRepository;
use App\Domain\Admin\Text\Models\Text;
use App\System\Breadcrumbs\Breadcrumbs;
use Src\Core\URI;
use Src\Translation\Translation;

/**
 * @var \App\Domain\Admin\Event\Repositories\EventRepository $eventRepository */
$eventRepository = $eventRepo ?? NULL;
$text = new Text();
$breadcrumbs = new Breadcrumbs(URI::getUrl());
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
            <?php echo parseHtmlEntities($eventRepository->getContent()) ?>
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
                    <?php echo $text->get(
                    'er_zijn_geen_gearchiveerde_concerten',
                    Translation::get('no_archived_events_were_found_message')
                    ) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
