<?php
declare(strict_types=1);

use Domain\Admin\Pages\Repositories\PageRepository;

/** @var PageRepository $page */
$page = $pageRepo ?? null;
?>

<?php if ($page->getBanner() !== ''
    && $page->getThumbnail() !== ''
    && file_exists($page->getBanner())
    && file_exists($page->getThumbnail())
) : ?>
    <!-- Banner -->
    <section class="header">
        <img class="banner" src="<?= $page->getBanner() ?>"
             alt="<?= $page->getTitle() . ' image banner' ?>">

        <img class="thumbnail" src="<?= $page->getThumbnail() ?>"
             alt="<?= $page->getTitle() . ' image banner' ?>">
    </section>
<?php endif; ?>

<div class="container page">
    <div class="mt-5 mb-5">
        <?= parseHtmlEntities($page->getContent()) ?>
    </div>
</div>
