<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\Env\Env;
use Src\Translation\Translation;
?>
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-12 mr-2 mb-4">
                        <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                            <?php echo Translation::get('app_status') ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo ucfirst($env ?? Env::DEVELOPMENT) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-12 mr-2 mb-4">
                        <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                            <?php echo Translation::get('header_data') ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo $headerDataTable ?? Translation::get('no_header_data_available') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-12 mr-2 mb-4">
                        <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                            <?php echo Translation::get('session_settings') ?>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?php echo $sessionSettingsTable ?? Translation::get('no_session_settings_data_available') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-12 mr-2 mb-4">
                        <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                            PHP Informatie
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="scrollbox-vertical h-500">
                            <?php echo $phpinfo ?? '' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
