<?php
declare(strict_types=1);

use Src\Core\Request;

$request = new Request();
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Sessie instellingen
                </h4>
            </div>
            <div class="card-body scrollbox-horizontal">
                <?= $sessionSettingsTable ?? 'Geen sessie instellingen gevonden' ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Sessie gegevens
                </h4>
            </div>
            <div class="card-body scrollbox-horizontal">
                <?= $sessionDataTable ?? 'Geen sessie informatie gevonden' ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Cookie gegevens
                </h4>
            </div>
            <div class="card-body scrollbox-horizontal">
                <?= $cookieDataTable ?? 'Geen cookie informatie gevonden' ?>
            </div>
        </div>
    </div>
</div>
