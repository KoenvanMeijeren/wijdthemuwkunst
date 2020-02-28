<?php
declare(strict_types=1);

use Domain\Admin\Pages\Repositories\PageRepository;
use Src\Core\Request;

$request = new Request();

$documentRoot = $request->server(Request::DOCUMENT_ROOT);

/** @var PageRepository $page */
$page = $pageRepo ?? null;
?>

<?php if ($page->getBanner() !== ''
    && file_exists($documentRoot . $page->getBanner())
) : ?>
    <!-- Banner -->
    <section class="header">
        <img class="banner" src="<?= $page->getBanner() ?>"
             alt="<?= $page->getTitle() . ' image banner' ?>">
    </section>
<?php endif;
if ($page->getThumbnail() !== ''
    && file_exists($documentRoot . $page->getThumbnail())
) : ?>
    <!-- Thumbnail -->
    <section class="header">
        <img class="thumbnail" src="<?= $page->getThumbnail() ?>"
             alt="<?= $page->getTitle() . ' image banner' ?>">
    </section>
<?php endif; ?>

<div class="container page">
    <div class="mt-5 mb-5">
        <?= parseHtmlEntities($page->getContent()) ?>
    </div>
</div>
