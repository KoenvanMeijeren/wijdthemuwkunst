<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\SuperGlobals\Request;

$documentRoot = request()->server(Request::DOCUMENT_ROOT);

/** @var \Domain\Admin\Pages\Repositories\PageRepository $page */
$page = $pageRepo ?? NULL;
?>

<?php if ($page->getBanner() !== ''
    && file_exists($documentRoot . $page->getBanner())
) : ?>
    <!-- Banner -->
    <section class="header">
        <img class="banner" src="<?php echo $page->getBanner() ?>"
             alt="<?php echo $page->getTitle() . ' image banner' ?>">
    </section>
<?php endif;
if ($page->getThumbnail() !== ''
    && file_exists($documentRoot . $page->getThumbnail())
) : ?>
    <!-- Thumbnail -->
    <section class="header">
        <img class="thumbnail" src="<?php echo $page->getThumbnail() ?>"
             alt="<?php echo $page->getTitle() . ' image banner' ?>">
    </section>
<?php endif; ?>

<div class="container page">
    <div class="mt-5 mb-5">
        <?php echo html_entities_decode($page->getContent()) ?>
    </div>
</div>
