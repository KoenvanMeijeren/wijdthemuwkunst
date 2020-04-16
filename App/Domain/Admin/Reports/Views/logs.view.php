<?php
declare(strict_types=1);

use Src\Core\Request;
use Src\State\State;
use Src\Translation\Translation;

$request = new Request();
?>

<div class="row" id="logs">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h4 class="card-title">
                        <?= Translation::get('logs_data') ?>
                    </h4>

                    <?php if (count($logs ?? []) < 1) : ?>
                        <p class="mt-2 font-weight-bold">
                            <?= Translation::get('no_log_data_found') ?>
                            <?= $request->get('logDate') ?>.
                        </p>
                    <?php endif; ?>
                </div>

                <form class="form-inline float-right" method="get"
                      action="#logs">
                    <div class="form-group mr-2">
                        <label for="datepicker"></label>
                        <input type="text" name="date"
                               autocomplete="off"
                               placeholder="<?= Translation::get('form_date') ?>"
                               class="form-control" id="datepicker"
                               value="<?= $request->get('date') ?>">
                    </div>

                    <button class="btn btn-default-small border-0">
                        <?= Translation::get('filter_button') ?>
                    </button>

                    <?php if (isset($_GET['date'])) : ?>
                        <a href="/admin/reports/logs"
                           class="btn btn-success ml-3 border-0">
                            <?= Translation::get('reset_button') ?>
                        </a>
                    <?php endif; ?>
                </form>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (count($logs ?? []) > 0) : ?>
                        <div class="col-sm-4">
                            <div class="form-label-group">
                                <input type="text" id="searchLog"
                                       class="form-control"
                                       autocomplete="off"
                                       placeholder="Search">
                                <label for="searchLog">
                                    <b><?= Translation::get('form_search') ?></b>
                                </label>
                            </div>

                            <div class="scrollbox-vertical h-500">
                                <div class="list-group overflow-hidden"
                                     id="list-tab" role="tablist">
                                    <?php $active = 'active';
                                    foreach (($logs ?? []) as $key => $log) :
                                        if (strpos(
                                            $log['message'] ?? '',
                                            State::ERROR
                                        ) !== false
                                            || strpos(
                                                $log['message'] ?? '',
                                                State::FAILED
                                            ) !== false) {
                                            $class = 'active-danger';
                                        } else {
                                            $class = 'active-success';
                                        }
                                        ?>
                                        <a class="list-group-item list-group-item-action <?= $active . ' ' . $class ?>"
                                           id="list-<?= $key ?>-list"
                                           data-toggle="list"
                                           href="#list-<?= $key ?>" role="tab"
                                           aria-controls="<?= $key ?>">
                                            <?= $log['title'] ?? 'undefined' ?>
                                        </a>
                                        <?php $active = '';
                                    endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="tab-content" id="nav-tabContent">
                                <?php $active = 'active';
                                foreach (($logs ?? []) as $key => $log) : ?>
                                    <div
                                        class="tab-pane fade show <?= $active ?>"
                                        id="list-<?= $key ?>" role="tabpanel"
                                        aria-labelledby="list-<?= $key ?>">
                                        <h3 class="mt-0 pt-0"><?= $log['date'] ?? '' ?></h3>

                                        <ul class="list-group list-group-flush">
                                            <?php
                                            if (strpos(
                                    $log['message'] ?? '',
                                    'ERROR'
                                ) !== false
                                                || strpos(
                                                    $log['message'] ?? '',
                                                    'failed'
                                                ) !== false
                                            ) {
                                                $class = 'list-group-item-danger';
                                            } else {
                                                $class = 'list-group-item-success';
                                            }
                                            ?>
                                            <li class="list-group-item <?= $class ?>">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?= Translation::get('message') ?>:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['message'] ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?= Translation::get('url') ?>:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->url ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?= Translation::get('ip') ?>:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->ip ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?= Translation::get('http_method') ?>:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->http_method ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?= Translation::get('server') ?>:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->server ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?= Translation::get('referrer') ?>:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->referrer ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?= Translation::get('process_id') ?>:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->process_id ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php $active = '';
                                endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
