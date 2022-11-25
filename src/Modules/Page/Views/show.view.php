<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\SuperGlobals\ServerOptions;

$documentRoot = request()->server->get(ServerOptions::DOCUMENT_ROOT);

/** @var \Modules\Page\Entity\PageInterface $entity */
$entity = $page ?? NULL;
?>

<?php if ($entity->getBanner() && file_exists($documentRoot . $entity->getBanner())) : ?>
  <!-- Banner -->
  <section class="header">
    <img class="banner" src="<?= $entity->getBanner() ?>"
         alt="<?= $entity->getTitle() . ' image banner' ?>">
  </section>
<?php endif;
if ($entity->getThumbnail() && file_exists($documentRoot . $entity->getThumbnail())) : ?>
  <!-- Thumbnail -->
  <section class="header">
    <img class="thumbnail" src="<?= $entity->getThumbnail() ?>"
         alt="<?= $entity->getTitle() . ' image banner' ?>">
  </section>
<?php endif; ?>

<div class="container page">
  <div class="mt-5 mb-5">
    <?= html_entities_decode($entity->getContent()) ?>
  </div>
</div>
