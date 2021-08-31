<?php

/**
 * @file
 */

/** @var \Modules\Page\Entity\PageInterface $page_entity */
$page_entity = $page ?? NULL;
/** @var \Modules\Page\Entity\PageInterface $archived_page_entity */
$archived_page_entity = $archived_page ?? NULL;
/** @var \Modules\Event\Entity\EventInterface[] $event_entities */
$event_entities = $events ?? [];
/** @var \Modules\Event\Entity\EventInterface[] $archived_event_entities */
$archived_event_entities = $archived_events ?? [];
?>

<div class="container page">
    <div class="mt-5 mb-5">
        <div class="events-content">
            <?= html_entities_decode($page_entity->getContent()) ?>
        </div>

        <div class="row">
            <?php if (count($event_entities) > 0) :
              foreach ($event_entities as $event_entity) :
                ?>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="/concerten/concert/<?= $event_entity->getSlug() ?>"
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
                  <?= t('No events were found.') ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="row">
            <?php if (count($archived_event_entities) > 0) : ?>
                <div class="col-md-12 events-content">
                    <?= html_entities_decode($archived_page_entity->getContent()) ?>
                </div>

                <?php foreach ($archived_event_entities as $archived_event_entity) : ?>
                    <div class="col-md-4">
                        <div class="card">
                            <a href="/concerten/historie/concert/<?= $archived_event_entity->getSlug() ?>"
                               class="link-without-styling">
                                <img class="card-img-top"
                                     alt="<?= $archived_event_entity->getTitle() ?> thumbnail"
                                     src="<?= $archived_event_entity->getThumbnail() ?>"
                                >
                                <div class="card-body p-2">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <h4 class="card-title p-0 m-0">
                                                <?= $archived_event_entity->getTitle() ?>
                                            </h4>
                                        </div>
                                        <div class="col-md-4">
                                            <h4 class="card-title p-0 m-0">
                                                <?= $archived_event_entity->getDayNumber() ?>
                                                <?= $archived_event_entity->getShortDate() ?>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach;
            endif; ?>

            <?php if (count($archived_event_entities) > 3) : ?>
                <div class="col-md-12 text-center">
                    <a class="button" href="/concerten/historie">
                      <?= t('View more') ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
