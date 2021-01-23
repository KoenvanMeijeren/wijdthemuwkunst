<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\Translation\TranslationOld;

?>

<div class="container page">
    <div class="mt-5 mb-5">
        <h1 class="text-center"><?php echo $title ?? '' ?></h1>
        <p><?php echo TranslationOld::get('page_does_not_exists') ?></p>
    </div>
</div>
