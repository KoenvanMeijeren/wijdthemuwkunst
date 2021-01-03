<?php

/**
 * @file
 */

declare(strict_types=1);

use Domain\Admin\Accounts\User\Models\User;
use System\Request;
use Src\Security\CSRF;
use Src\Translation\Translation;

$request = new Request();
$user = new User();

/** @var \Domain\Admin\Text\Entity\TextInterface $entity */
$entity = $text ?? null;
$createText = $createText ?? FALSE;
$disabled = $user->getRights() === User::DEVELOPER ? '' : 'disabled';
?>
<?php if ($createText && $user->getRights() === User::DEVELOPER && $entity === NULL) : ?>
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 mr-2 mb-4">
                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                <?= Translation::get('add_text_title') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="/admin/configuration/texts/text/create/store">
                                <?= CSRF::insertToken('/admin/configuration/texts/text/create/store') ?>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="key">
                                            <?= Translation::get('form_key') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="key"
                                               id="key"
                                               class="form-control"
                                               placeholder="<?= Translation::get('form_key') ?>"
                                               value="<?= $request->post('key') ?>"
                                               required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="value">
                                            <?= Translation::get('form_value') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="value"
                                               id="value"
                                               class="form-control"
                                               placeholder="<?= Translation::get('form_value') ?>"
                                               value="<?= $request->post('value') ?>"
                                               required>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="/admin/configuration/texts"
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
<?php elseif ($entity !== NULL) : ?>
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 mr-2 mb-4">
                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                <?= sprintf(Translation::get('edit_text_title'), $entity->getKey()) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form method="post"
                                  action="/admin/configuration/texts/text/edit/<?= $entity->id() ?>/update">
                                <?= CSRF::insertToken("/admin/configuration/texts/text/edit/{$entity->id()}/update") ?>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="key">
                                            <?= Translation::get('form_key') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="key" id="key" class="form-control" <?= $disabled ?>
                                               placeholder="<?= Translation::get('form_key') ?>"
                                               value="<?= $request->post('key', $entity->getKey()) ?>" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="value">
                                            <?= Translation::get('form_value') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="value" id="value" class="form-control"
                                               placeholder="<?= Translation::get('form_value') ?>"
                                               value="<?= $request->post('value', $entity->getValue()) ?>"
                                               required>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="/admin/configuration/texts"
                                       class="btn btn-outline-danger float-left"
                                       data-toggle="tooltip" data-placement="top"
                                       title="<?= Translation::get('reset_button') ?>">
                                        <?= Translation::get('reset_button') ?>
                                    </a>

                                    <button type="submit" data-toggle="tooltip" data-placement="top"
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
                            <?= Translation::get('texts_overview_title') ?>
                        </div>

                        <a href="/admin/configuration/texts/text/create"
                           class="btn btn-outline-primary float-right"
                           data-toggle="tooltip" data-placement="top" title="Toevoegen">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <?= $texts ?? '' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
