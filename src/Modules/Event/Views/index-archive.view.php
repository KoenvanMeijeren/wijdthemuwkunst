<?php

/**
 * @file
 */

use Components\SuperGlobals\Url\Uri;
use System\Breadcrumbs\Breadcrumbs;

/** @var \Modules\Page\Entity\PageInterface $page_entity */
$page_entity = $page ?? NULL;
/** @var \Modules\Event\Entity\EventInterface[] $event_entities */
$event_entities = $events ?? [];
$breadcrumbs = new Breadcrumbs(Uri::getUrl());
?>

<div class="container page">
    <div class="mt-5 mb-5">
        <?php if ($breadcrumbs->visible()) : ?>
            <div class="row breadcrumbs">
                <div class="col-sm-12">
                    <?= $breadcrumbs->generate() ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="events-content">
            <?= html_entities_decode($page_entity->getContent()) ?>
        </div>

        <div class="row">
            <?php if (count($event_entities) > 0) :
              foreach ($event_entities as $event_entity) : ?>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="/concerten/historie/concert/<?= $event_entity->getSlug() ?>"
                                class="link-without-styling">
                                <img class="card-img-top"
                                     alt="<?= $event_entity->getTitle() ?> thumbnail"
                                     src="<?= $event_entity->getThumbnail() ?>"
                                >
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 class="card-title p-0 m-0">
                                                <?= $event_entity->getTitle() ?>
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="card-title p-0 m-0">
                                                <?= $event_entity->getDayNumber() ?>
                                                <?= $event_entity->getShortDate() ?>
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
