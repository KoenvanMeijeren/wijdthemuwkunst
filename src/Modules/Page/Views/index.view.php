<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\SuperGlobals\ServerOptions;

$documentRoot = request()->server(ServerOptions::DOCUMENT_ROOT);

/** @var \Modules\Page\Entity\PageInterface $page_entity */
$page_entity = $page ?? NULL;
/** @var \Modules\Page\Entity\PageInterface $event_page_entity */
$event_page_entity = $event_page ?? NULL;
/** @var \Modules\Event\Entity\EventInterface[] $event_entities */
$event_entities = $events ?? NULL;
?>

<?php if ($page_entity->getBanner() !== '' && file_exists($documentRoot . $page_entity->getBanner())) : ?>
  <!-- Banner -->
  <section class="header">
    <img class="banner" src="<?= $page_entity->getBanner() ?>"
         alt="<?= $page_entity->getTitle() . ' image banner' ?>">
  </section>
<?php else : ?>
  <section class="header">
    <img class="banner" src="/themes/whuk_theme/src/images/banner.jpg"
         alt="<?= $page_entity->getTitle() . ' image banner' ?>">
  </section>
<?php endif;
if ($page_entity->getThumbnail() !== '' && file_exists($documentRoot . $page_entity->getThumbnail())) : ?>
  <!-- Thumbnail -->
  <section class="header">
    <img class="thumbnail" src="<?= $page_entity->getThumbnail() ?>"
         alt="<?= $page_entity->getTitle() . ' image banner' ?>">
  </section>
<?php endif; ?>

<div class="container page">
  <?php if ($page_entity->getContent() !== '') : ?>
    <div class="mt-5 mb-5">
      <?= html_entities_decode($page_entity->getContent()) ?>
    </div>
  <?php endif; ?>

  <?php if (count($event_entities) > 0) : ?>
    <div class="mt-5 mb-5">
      <div class="row">
        <div class="events-content">
          <?= html_entities_decode($event_page_entity->getContent()) ?>
        </div>
      </div>

      <div class="row">
        <?php foreach ($event_entities as $eventEntity) : ?>
          <div class="col-md-4">
            <div class="card">
              <a href="/concerten/concert/<?= $eventEntity->getSlug() ?>"
                 class="link-without-styling">
                <img class="card-img-top"
                     alt="<?= $eventEntity->getTitle() ?> thumbnail"
                     src="<?= $eventEntity->getThumbnail() ?>"
                >
                <div class="card-body p-2">
                  <div class="row">
                    <div class="col-md-8">
                      <h4 class="card-title p-0 m-0">
                        <?= $eventEntity->getTitle() ?>
                      </h4>
                    </div>
                    <div class="col-md-4">
                      <h4 class="card-title p-0 m-0">
                        <?= $eventEntity->getDayNumber() ?>
                        <?= $eventEntity->getShortDate() ?>
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
