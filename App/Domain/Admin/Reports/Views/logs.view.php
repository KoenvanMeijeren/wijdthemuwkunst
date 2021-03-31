<?php
declare(strict_types=1);

use Src\Core\Request;
use Src\State\State;
use Src\Translation\Translation;

$request = new Request();
?>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-left-warning shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-12 mr-2 mb-4">
                        <div
                            class="text-lg font-weight-bold text-primary text-uppercase mb-1 float-left">
                            <?= Translation::get('logs_data') ?>
                        </div>

                        <form class="form-inline float-right" method="get">
                            <div class="form-group mr-2">
                                <label for="unlimited-datepicker"></label>
                                <input type="text" name="date"
                                       autocomplete="off"
                                       placeholder="<?= Translation::get('form_date') ?>"
                                       class="form-control"
                                       id="unlimited-datepicker"
                                       value="<?= $request->get('date') ?>">
                            </div>

                            <button class="btn btn-outline-primary">
                                <?= Translation::get('filter_button') ?>
                            </button>

                            <?php if (isset($_GET['date'])) : ?>
                                <a href="/admin/reports/logs"
                                   class="btn btn-outline-danger ml-3">
                                    <?= Translation::get('reset_button') ?>
                                </a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <?php if (count($logs ?? []) < 1) : ?>
                        <div class="col-md-12">
                            <p class="mt-2 font-weight-bold">
                                <?= Translation::get('no_log_data_found') ?>
                                <?= $request->get('date') ?>.
                            </p>
                        </div>
                    <?php else: ?>
                        <div class="col-sm-4">
                            <div class="form-label-group mb-2">
                                <label for="searchLog" class="visually-hidden">
                                    <b><?= Translation::get('form_search') ?></b>
                                </label>
                                <input type="text" id="searchLog"
                                       class="form-control" autocomplete="off"
                                       placeholder="Zoeken">
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
                                                        <?= Translation::get('message') ?>
                                                        :
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['message'] ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?= Translation::get('url') ?>
                                                        :
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->url ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?= Translation::get('ip') ?>
                                                        :
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->ip ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?= Translation::get('http_method') ?>
                                                        :
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->http_method ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?= Translation::get('server') ?>
                                                        :
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->server ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?= Translation::get('referrer') ?>
                                                        :
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->referrer ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?= Translation::get('process_id') ?>
                                                        :
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