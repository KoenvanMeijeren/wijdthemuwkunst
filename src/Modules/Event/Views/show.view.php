<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\SuperGlobals\ServerOptions;
use Components\SuperGlobals\Url\Uri;
use System\Breadcrumbs\Breadcrumbs;

$documentRoot = request()->server->get(ServerOptions::DOCUMENT_ROOT);

/** @var \Modules\Event\Entity\EventInterface $entity */
$entity = $event ?? NULL;
$breadcrumbs = new Breadcrumbs(Uri::getUrl());
?>

<?php if ($entity->getBanner() !== ''
    && file_exists($documentRoot . $event->getBanner())
) : ?>
    <!-- Banner -->
    <section class="header">
        <img class="banner" src="<?= $entity->getBanner() ?>"
             alt="<?= $entity->getTitle() . ' image banner' ?>">
    </section>
<?php endif; ?>

<?php if ($entity->getThumbnail() !== ''
    && file_exists($documentRoot . $entity->getThumbnail())
) : ?>
    <!-- Thumbnail -->
    <section class="header">
        <img class="thumbnail" src="<?= $entity->getThumbnail() ?>"
             alt="<?= $entity->getTitle() . ' image thumbnail' ?>">
    </section>
<?php endif; ?>

<div class="container page">
    <div class="mt-5 mb-5">
        <?php if ($breadcrumbs->visible()) : ?>
            <div class="row breadcrumbs">
                <div class="col-sm-12">
                    <?= $breadcrumbs->generate() ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col">
                <h1>
                    <?= $entity->getTitle() ?>
                </h1>
                <h4>
                    <i class="fas fa-calendar-alt"></i>
                    <?= $entity->getReadableDatetime() ?>

                    <span class="mr-5"></span>

                    <i class="fas fa-map-marker-alt"></i>
                    <?= $entity->getLocation() ?>
                </h4>
            </div>
        </div>

        <?= html_entities_decode($entity->getContent()) ?>
    </div>
</div>
