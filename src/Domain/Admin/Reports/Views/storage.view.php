<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\Translation\TranslationOld;
use System\Request;

$request = new Request();
?>
<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-left-warning shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-12 mr-2 mb-4">
                        <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                            <?php echo TranslationOld::get('session_data') ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo $sessionDataTable ?? TranslationOld::get('no_session_data_available') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-left-warning shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-12 mr-2 mb-4">
                        <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                            <?php echo TranslationOld::get('cookie_data') ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo $cookieDataTable ?? TranslationOld::get('no_cookie_data_available') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
