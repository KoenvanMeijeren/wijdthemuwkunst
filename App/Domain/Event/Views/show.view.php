<?php
declare(strict_types=1);

use App\Domain\Admin\Event\Repositories\EventRepository;
use Src\Core\Request;

$request = new Request();

$documentRoot = $request->server(Request::DOCUMENT_ROOT);

/** @var EventRepository $event */
$event = $eventRepo ?? null;
?>

<?php if ($event->getBanner() !== ''
    && $event->getThumbnail() !== ''
    && file_exists($documentRoot . $event->getBanner())
    && file_exists($documentRoot . $event->getThumbnail())
) : ?>
    <!-- Banner -->
    <section class="header">
        <img class="banner" src="<?= $event->getBanner() ?>"
             alt="<?= $event->getTitle() . ' image banner' ?>">

        <img class="thumbnail" src="<?= $event->getThumbnail() ?>"
             alt="<?= $event->getTitle() . ' image banner' ?>">
    </section>
<?php endif; ?>

<div class="container page">
    <div class="mt-5 mb-5">
        <?= parseHtmlEntities($event->getContent()) ?>
    </div>
</div>
