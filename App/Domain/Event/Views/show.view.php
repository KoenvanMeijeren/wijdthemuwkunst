<?php

/**
 * @file
 */

declare(strict_types=1);

use App\System\Breadcrumbs\Breadcrumbs;
use Src\Core\Request;
use Src\Core\URI;

$request = new Request();

$documentRoot = $request->server(Request::DOCUMENT_ROOT);

/**
 * @var \App\Domain\Admin\Event\Repositories\EventRepository $event */
$event = $eventRepo ?? NULL;
$breadcrumbs = new Breadcrumbs(URI::getUrl());
?>

<?php if ($event->getBanner() !== ''
    && file_exists($documentRoot . $event->getBanner())
) : ?>
    <!-- Banner -->
    <section class="header">
        <img class="banner" src="<?php echo $event->getBanner() ?>"
             alt="<?php echo $event->getTitle() . ' image banner' ?>">
    </section>
<?php endif; ?>

<?php if ($event->getThumbnail() !== ''
    && file_exists($documentRoot . $event->getThumbnail())
) : ?>
    <!-- Thumbnail -->
    <section class="header">
        <img class="thumbnail" src="<?php echo $event->getThumbnail() ?>"
             alt="<?php echo $event->getTitle() . ' image thumbnail' ?>">
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
                    <?php echo $event->getTitle() ?>
                </h1>
                <h4>
                    <i class="fas fa-calendar-alt"></i>
                    <?php echo $event->getReadableDatetime() ?>

                    <span class="mr-5"></span>

                    <i class="fas fa-map-marker-alt"></i>
                    <?php echo $event->getLocation() ?>
                </h4>
            </div>
        </div>

        <?php echo parseHtmlEntities($event->getContent()) ?>
    </div>
</div>
