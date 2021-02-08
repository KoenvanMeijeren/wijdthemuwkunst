<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\Translation\TranslationOld;
use System\StateInterface;

?>

<div class="row">
    <div class="col-md-12 mb-4">
        <div class="card border-left-warning shadow py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-12 mr-2 mb-4">
                        <div
                            class="text-lg font-weight-bold text-primary text-uppercase mb-1 float-left">
                            <?php echo TranslationOld::get('logs_data') ?>
                        </div>

                        <form class="form-inline float-right" method="get">
                            <div class="form-group mr-2">
                                <label for="unlimited-datepicker"></label>
                                <input type="text" name="date"
                                       autocomplete="off"
                                       placeholder="<?php echo TranslationOld::get('form_date') ?>"
                                       class="form-control"
                                       id="unlimited-datepicker"
                                       value="<?php echo request()->get('date') ?>">
                            </div>

                            <button class="btn btn-outline-primary">
                                <?php echo TranslationOld::get('filter_button') ?>
                            </button>

                            <?php if (isset($_GET['date'])) : ?>
                                <a href="/admin/reports/logs"
                                   class="btn btn-outline-danger ml-3">
                                    <?php echo TranslationOld::get('reset_button') ?>
                                </a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <?php if (count($logs ?? []) < 1) : ?>
                        <div class="col-md-12">
                            <p class="mt-2 font-weight-bold">
                                <?php echo TranslationOld::get('no_log_data_found') ?>
                                <?php echo request()->get('date') ?>.
                            </p>
                        </div>
                    <?php else : ?>
                        <div class="col-sm-4">
                            <div class="form-label-group mb-2">
                                <label for="searchLog" class="visually-hidden">
                                    <b><?php echo TranslationOld::get('form_search') ?></b>
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
                                      $class = 'active-success';
                                      if (str_contains($log['message'] ?? '', StateInterface::ERROR)
                                            || str_contains($log['message'] ?? '', StateInterface::FAILED)) {
                                        $class = 'active-danger';
                                      }
                                      ?>
                                        <a class="list-group-item list-group-item-action <?php echo $active . ' ' . $class ?>"
                                           id="list-<?php echo $key ?>-list"
                                           data-toggle="list"
                                           href="#list-<?php echo $key ?>" role="tab"
                                           aria-controls="<?php echo $key ?>">
                                            <?php echo $log['title'] ?? 'undefined' ?>
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
                                        class="tab-pane fade show <?php echo $active ?>"
                                        id="list-<?php echo $key ?>" role="tabpanel"
                                        aria-labelledby="list-<?php echo $key ?>">
                                        <h3 class="mt-0 pt-0"><?php echo $log['date'] ?? '' ?></h3>

                                        <ul class="list-group list-group-flush">
                                            <?php
                                            if (str_contains($log['message'] ?? '', 'ERROR')
                                                || str_contains($log['message'] ?? '', 'failed')
                                            ) {
                                              $class = 'list-group-item-danger';
                                            }
                                            else {
                                              $class = 'list-group-item-success';
                                            }
                                            ?>
                                            <li class="list-group-item <?php echo $class ?>">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?php echo TranslationOld::get('message') ?>
                                                        :
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?php echo $log['message'] ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?php echo TranslationOld::get('url') ?>
                                                        :
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?php echo $log['meta']->url ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?php echo TranslationOld::get('ip') ?>
                                                        :
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?php echo $log['meta']->ip ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?php echo TranslationOld::get('http_method') ?>
                                                        :
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?php echo $log['meta']->http_method ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?php echo TranslationOld::get('server') ?>
                                                        :
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?php echo $log['meta']->server ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?php echo TranslationOld::get('referrer') ?>
                                                        :
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?php echo $log['meta']->referrer ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?php echo TranslationOld::get('process_id') ?>
                                                        :
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?php echo $log['meta']->process_id ?? '' ?>
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
