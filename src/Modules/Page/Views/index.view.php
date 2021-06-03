<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\SuperGlobals\Request;
use Domain\Admin\Event\Repositories\EventRepository;

$documentRoot = request()->server(Request::DOCUMENT_ROOT);

/** @var \Modules\Page\Entity\PageInterface $pageEntity */
$pageEntity = $page ?? NULL;
/** @var \Modules\Page\Entity\PageInterface[] $eventEntities */
$eventEntity = $event ?? NULL;
?>

<?php if ($pageEntity->getBanner() !== '' && file_exists($documentRoot . $pageEntity->getBanner())) : ?>
  <!-- Banner -->
  <section class="header">
    <img class="banner" src="<?= $pageEntity->getBanner() ?>"
         alt="<?= $pageEntity->getTitle() . ' image banner' ?>">
  </section>
<?php else : ?>
  <section class="header">
    <img class="banner" src="/themes/whuk_theme/src/images/banner.jpg"
         alt="<?= $pageEntity->getTitle() . ' image banner' ?>">
  </section>
<?php endif;
if ($pageEntity->getThumbnail() !== '' && file_exists($documentRoot . $pageEntity->getThumbnail())) : ?>
  <!-- Thumbnail -->
  <section class="header">
    <img class="thumbnail" src="<?= $pageEntity->getThumbnail() ?>"
         alt="<?= $pageEntity->getTitle() . ' image banner' ?>">
  </section>
<?php endif; ?>

<div class="container page">
  <?php if ($pageEntity->getContent() !== '') : ?>
    <div class="mt-5 mb-5">
      <?= html_entities_decode($pageEntity->getContent()) ?>
    </div>
  <?php endif; ?>

  <?php if (isset($events) && !empty($events)) : ?>
    <div class="mt-5 mb-5">
      <div class="row">
        <div class="events-content">
          <?= html_entities_decode($eventEntity->getContent()) ?>
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
