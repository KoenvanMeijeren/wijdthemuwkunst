<?php
declare(strict_types=1);

use Src\Core\Env;
use Src\Core\Request;

$request = new Request();
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Applicatie status
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
                    Header gegevens
                </h4>
            </div>
            <div class="card-body scrollbox-horizontal">
                <?= $headerDataTable ?? 'Geen header informatie gevonden' ?>
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
