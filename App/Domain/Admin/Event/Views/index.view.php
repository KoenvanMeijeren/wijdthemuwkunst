<?php
declare(strict_types=1);

use Src\Translation\Translation; ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-left">
                    <?= Translation::get('event_overview_title') ?>
                </h4>

                <a href="/admin/content/events/event/create"
                   class="btn btn-default-small float-right"
                   data-toggle="tooltip"
                   data-placement="top"
                   title="Toevoegen">
                    <i class="fas fa-plus"></i>
                </a>
            </div>
            <div class="card-body">
                <?= $events ?? '' ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-left">
                    <?= Translation::get('event_archive_overview_title') ?>
                </h4>
            </div>
            <div class="card-body">
                <?= $archived_events ?? '' ?>
            </div>
        </div>
    </div>
</div>
