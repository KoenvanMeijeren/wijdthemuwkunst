<?php
declare(strict_types=1);

$items ??= [];
?>
<div class="row">
    <?php foreach ($items as $item) : ?>
        <div class="col-md-3">
            <a href="<?= $item['link'] ?? '' ?>">
                <div class="card text-center">
                    <div class="card-header">
                        <h1 class="card-title">
                            <i class="<?= $item['icon'] ?? '' ?>"></i>
                        </h1>
                    </div>
                    <div class="card-body">
                        <a href="<?= $item['link'] ?? '' ?>"
                           class="btn btn-warning btn-block">
                            <?= $item['title'] ?? '' ?>
                        </a>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
