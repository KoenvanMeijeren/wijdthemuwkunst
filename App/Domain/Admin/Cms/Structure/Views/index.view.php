<?php
declare(strict_types=1);

$items ??= [];
?>
<div class="row">
    <?php foreach ($items as $item) : ?>
        <div class="col-xl-3 col-md-6 mb-4">
            <a href="<?= $item['link'] ?? '' ?>">
                <div class="card border-left-primary shadow h-100 py-2 card-hover">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-md font-weight-bold text-primary text-uppercase mb-1">
                                    <?= $item['title'] ?? '' ?>
                                </div>
                            </div>

                            <div class="col-auto">
                                <i class="<?= $item['icon'] ?? '' ?> fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>
