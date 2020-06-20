<?php
declare(strict_types=1);

use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Settings\Repositories\SettingRepository;
use Src\Core\Request;
use Src\Security\CSRF;
use Src\Translation\Translation;

$setting = new SettingRepository($setting ?? null);
$request = new Request();
$user = new User();

$createSetting = $createSetting ?? false;
$disabled = $user->getRights() === User::DEVELOPER ? '' : 'disabled';
?>
<?php if ($createSetting && $user->getRights() === User::DEVELOPER && $setting->get() === null) : ?>
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 mr-2 mb-4">
                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                <?= Translation::get('add_setting_title') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="/admin/configuration/settings/setting/create/store">
                                <?= CSRF::insertToken('/admin/configuration/settings/setting/create/store') ?>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="setting_key">
                                            <?= Translation::get('form_key') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="setting_key"
                                               id="setting_key"
                                               class="form-control"
                                               placeholder="<?= Translation::get('form_key') ?>"
                                               value="<?= $request->post('setting_key') ?>"
                                               required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="setting_value">
                                            <?= Translation::get('form_value') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="setting_value"
                                               id="setting_value"
                                               class="form-control"
                                               placeholder="<?= Translation::get('form_value') ?>"
                                               value="<?= $request->post('setting_value') ?>"
                                               required>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <a href="/admin/configuration/settings/setting/create"
                                       class="btn btn-outline-danger float-left"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="<?= Translation::get('reset_button') ?>">
                                        <?= Translation::get('reset_button') ?>
                                    </a>

                                    <button type="submit"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="<?= Translation::get('save_button') ?>"
                                            class="btn btn-outline-success float-right">
                                        <?= Translation::get('save_button') ?>
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
<?php elseif ($setting->get() !== null) : ?>
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 mr-2 mb-4">
                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                <?= sprintf(
                                    Translation::get('edit_setting_title'),
                                    $setting->getReadableKey()
                                ) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form method="post"
                                  action="/admin/configuration/settings/setting/edit/<?= $setting->getId() ?>/update">
                                <?= CSRF::insertToken("/admin/configuration/settings/setting/edit/{$setting->getId()}/update") ?>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="setting_key">
                                            <?= Translation::get('form_key') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="setting_key"
                                               id="setting_key"
                                               class="form-control"
                                            <?= $disabled ?>
                                               placeholder="<?= Translation::get('form_key') ?>"
                                               value="<?= $request->post(
                                                   'setting_key',
                                                   $setting->getReadableKey()
                                               ) ?>"
                                               required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="setting_value">
                                            <?= Translation::get('form_value') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="setting_value"
                                               id="setting_value"
                                               class="form-control"
                                               placeholder="<?= Translation::get('form_value') ?>"
                                               value="<?= $request->post(
                                                   'setting_value',
                                                   $setting->getValue()
                                               ) ?>"
                                               required>
                                    </div>
                                </div>

                                <div class="mt-3">
                                    <a href="/admin/configuration/settings"
                                       class="btn btn-outline-danger float-left"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="<?= Translation::get('reset_button') ?>">
                                        <?= Translation::get('reset_button') ?>
                                    </a>

                                    <button type="submit"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="<?= Translation::get('save_button') ?>"
                                            class="btn btn-outline-success float-right">
                                        <?= Translation::get('save_button') ?>
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
                            <?= Translation::get('settings_overview_title') ?>
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
