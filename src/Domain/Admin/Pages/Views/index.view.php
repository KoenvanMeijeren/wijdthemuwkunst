<?php

/**
 * @file
 */

declare(strict_types=1);

use Src\Translation\Translation;

?>
<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-12 mr-2 mb-4">
                        <div class="text-lg float-left font-weight-bold text-primary text-uppercase mb-1">
                            <?php echo Translation::get('pages_overview_title') ?>
                        </div>

                        <a href="/admin/content/pages/page/create"
                           class="btn btn-outline-primary float-right"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Toevoegen">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo $pages ?? '' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
