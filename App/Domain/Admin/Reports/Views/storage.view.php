<?php
declare(strict_types=1);

use Src\Core\Request;
use Src\Translation\Translation;

$request = new Request();
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <?= Translation::get('session_data') ?>
                </h4>
            </div>
            <div class="card-body scrollbox-horizontal">
                <?= $sessionDataTable ?? Translation::get('no_session_data_available') ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <?= Translation::get('cookie_data') ?>
                </h4>
            </div>
            <div class="card-body scrollbox-horizontal">
                <?= $cookieDataTable ?? Translation::get('no_cookie_data_available') ?>
            </div>
        </div>
    </div>
</div>
