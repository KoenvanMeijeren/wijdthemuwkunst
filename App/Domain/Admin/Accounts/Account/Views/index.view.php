<?php
declare(strict_types=1);

use Src\Translation\Translation;

?>
<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-12 mr-2 mb-4">
                        <div class="text-lg font-weight-bold text-primary text-uppercase mb-1 float-left">
                            <?= Translation::get('admin_accounts_maintenance_title') ?>
                        </div>

                        <a href="/admin/account/create"
                           class="btn btn-outline-primary float-right"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Toevoegen">
                            <i class="fas fa-user-plus"></i>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?= $accounts ?? Translation::get('no_accounts_were_found_message') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
