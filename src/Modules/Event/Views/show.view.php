<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\SuperGlobals\Request;
use Components\SuperGlobals\Url\Uri;
use System\Breadcrumbs\Breadcrumbs;

$documentRoot = request()->server(Request::DOCUMENT_ROOT);

/** @var \Modules\Event\Entity\EventInterface $entity */
$entity = $event ?? NULL;
$breadcrumbs = new Breadcrumbs(Uri::getUrl());
?>

<?php if ($entity->getBanner() !== ''
    && file_exists($documentRoot . $event->getBanner())
) : ?>
    <!-- Banner -->
    <section class="header">
        <img class="banner" src="<?php echo $entity->getBanner() ?>"
             alt="<?php echo $entity->getTitle() . ' image banner' ?>">
    </section>
<?php endif; ?>

<?php if ($entity->getThumbnail() !== ''
    && file_exists($documentRoot . $entity->getThumbnail())
) : ?>
    <!-- Thumbnail -->
    <section class="header">
        <img class="thumbnail" src="<?php echo $entity->getThumbnail() ?>"
             alt="<?php echo $entity->getTitle() . ' image thumbnail' ?>">
    </section>
<?php endif; ?>

<div class="container page">
    <div class="mt-5 mb-5">
        <?php if ($breadcrumbs->visible()) : ?>
            <div class="row breadcrumbs">
                <div class="col-sm-12">
                    <?php echo $breadcrumbs->generate() ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="col">
                <h1>
                    <?php echo $entity->getTitle() ?>
                </h1>
                <h4>
                    <i class="fas fa-calendar-alt"></i>
                    <?php echo $entity->getReadableDatetime() ?>

                    <span class="mr-5"></span>

                    <i class="fas fa-map-marker-alt"></i>
                    <?php echo $entity->getLocation() ?>
                </h4>
            </div>
        </div>

        <?php echo html_entities_decode($entity->getContent()) ?>
    </div>
</div>
