<?php
declare(strict_types=1);

use Src\Core\Env;
use Src\Core\Request;
use Src\Translation\Translation;

$request = new Request();
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <?= Translation::get('app_status') ?>
                </h4>
            </div>
            <div class="card-body">
                <p class="font-weight-bold">
                    <?= ucfirst($env ?? Env::DEVELOPMENT) ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <?= Translation::get('header_data') ?>
                </h4>
            </div>
            <div class="card-body scrollbox-horizontal">
                <?= $headerDataTable ?? Translation::get('no_header_data_available') ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <?= Translation::get('session_settings') ?>
                </h4>
            </div>
            <div class="card-body scrollbox-horizontal">
                <?= $sessionSettingsTable ?? Translation::get('no_session_settings_data_available') ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="scrollbox-vertical h-500">
                    <?= $phpinfo ?? '' ?>
                </div>
            </div>
        </div>
    </div>
</div>
