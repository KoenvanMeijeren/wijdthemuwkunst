<?php

/**
 * @file
 * The index view for settings.
 */

declare(strict_types=1);

use Components\Security\CSRF;
use Components\Translation\TranslationOld;
use Modules\User\Entity\AccountInterface;

/** @var \Modules\Setting\Entity\SettingInterface $entity */
$entity = $setting ?? null;
$createSetting = $createSetting ?? FALSE;
$disabled = user()->getRights() === AccountInterface::DEVELOPER ? '' : 'disabled';
?>
<?php if (!$entity && $createSetting && user()->getRights() === AccountInterface::DEVELOPER) : ?>
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 mr-2 mb-4">
                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                <?= TranslationOld::get('add_setting_title') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="/admin/configuration/settings/setting/create/store">
                                <?= CSRF::insertToken('/admin/configuration/settings/setting/create/store') ?>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="key">
                                            <?= TranslationOld::get('form_key') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="key"
                                               id="key" class="form-control"
                                               placeholder="<?= TranslationOld::get('form_key') ?>"
                                               value="<?= request()->post('key') ?>"
                                               required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="value">
                                            <?= TranslationOld::get('form_value') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="value"
                                               id="value" class="form-control"
                                               placeholder="<?= TranslationOld::get('form_value') ?>"
                                               value="<?= request()->post('value') ?>"
                                               required>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <a href="/admin/configuration/settings/setting/create"
                                       class="btn btn-outline-danger float-left"
                                       data-toggle="tooltip" data-placement="top"
                                       title="<?= TranslationOld::get('reset_button') ?>">
                                        <?= TranslationOld::get('reset_button') ?>
                                    </a>

                                    <button type="submit"
                                            data-toggle="tooltip" data-placement="top"
                                            title="<?= TranslationOld::get('save_button') ?>"
                                            class="btn btn-outline-success float-right">
                                        <?= TranslationOld::get('save_button') ?>
                                        <i class="far fa-save"></i>
                                    </button>
                                </div>

                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($entity !== NULL) : ?>
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 mr-2 mb-4">
                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                <?= sprintf(TranslationOld::get('edit_setting_title'), $entity->getReadableKey()) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form method="post"
                                  action="/admin/configuration/settings/setting/edit/<?= $entity->id() ?>/update">
                                <?= CSRF::insertToken("/admin/configuration/settings/setting/edit/{$entity->id()}/update") ?>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="key">
                                            <?= TranslationOld::get('form_key') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="key"
                                               id="key" class="form-control"
                                            <?= $disabled ?>
                                               placeholder="<?= TranslationOld::get('form_key') ?>"
                                               value="<?= request()->post('key', $entity->getReadableKey()) ?>"
                                               required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="value">
                                            <?= TranslationOld::get('form_value') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="value"
                                               id="value" class="form-control"
                                               placeholder="<?= TranslationOld::get('form_value') ?>"
                                               value="<?= request()->post('value', $entity->getValue()) ?>"
                                               required>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <a href="/admin/configuration/settings"
                                       class="btn btn-outline-danger float-left"
                                       data-toggle="tooltip" data-placement="top"
                                       title="<?= TranslationOld::get('reset_button') ?>">
                                        <?= TranslationOld::get('reset_button') ?>
                                    </a>

                                    <button type="submit"
                                            data-toggle="tooltip" data-placement="top"
                                            title="<?= TranslationOld::get('save_button') ?>"
                                            class="btn btn-outline-success float-right">
                                        <?= TranslationOld::get('save_button') ?>
                                        <i class="far fa-save"></i>
                                    </button>
                                </div>

                                <div class="clearfix"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-12 mr-2 mb-4">
                        <div class="text-lg font-weight-bold text-primary text-uppercase mb-1 float-left">
                            <?= TranslationOld::get('settings_overview_title') ?>
                        </div>

                        <a href="/admin/configuration/settings/setting/create"
                           class="btn btn-outline-primary float-right"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Toevoegen">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?= $settings ?? '' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
