<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\Security\CSRF;
use Components\Translation\TranslationOld;

/** @var \Modules\Menu\Entity\MenuInterface $menu_item */
$menu_item = $menu_item ?? null;
$create_menu_item = $create_menu_item ?? FALSE;
?>
<?php if ($create_menu_item && $menu_item === NULL) : ?>
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 mr-2 mb-4">
                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                <?= TranslationOld::get('add_menu_item_title') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="/admin/structure/menu/item/create/store">
                                <?= CSRF::insertToken('/admin/structure/menu/item/create/store') ?>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <label for="slug">
                                            <?= TranslationOld::get('form_page_slug') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="slug" id="slug" class="form-control"
                                               placeholder="<?= TranslationOld::get('form_page_slug') ?>"
                                               value="<?= request()->post('slug') ?>" required>
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="title">
                                            <?= TranslationOld::get('form_title') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="title" id="title" class="form-control"
                                               placeholder="<?= TranslationOld::get('form_title') ?>"
                                               value="<?= request()->post('title') ?>" required>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="weight">
                                            <?= TranslationOld::get('form_weight') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" name="weight" id="weight" class="form-control"
                                               placeholder="<?= TranslationOld::get('form_weight') ?>"
                                               value="<?= request()->post('weight') ?>" required>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="/admin/structure/menu" class="btn btn-outline-danger float-left"
                                       data-toggle="tooltip" data-placement="top"
                                       title="<?= TranslationOld::get('reset_button') ?>">
                                        <?= TranslationOld::get('reset_button') ?>
                                    </a>

                                    <button type="submit" data-toggle="tooltip" data-placement="top"
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
<?php elseif ($menu_item !== NULL) : ?>
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 mr-2 mb-4">
                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                <?= sprintf(TranslationOld::get('edit_menu_item_title'), $menu_item->getTitle()) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form method="post"
                                  action="/admin/structure/menu/item/edit/<?= $menu_item->id() ?>/update">
                                <?= CSRF::insertToken("/admin/structure/menu/item/edit/{$menu_item->id()}/update") ?>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <label for="slug">
                                            <?= TranslationOld::get('form_page_slug') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="slug" id="slug" class="form-control"
                                               placeholder="<?= TranslationOld::get('form_page_slug') ?>"
                                               value="<?= request()->post('slug', $menu_item->getSlug()) ?>"
                                               required>
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="title">
                                            <?= TranslationOld::get('form_title') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="title" id="title" class="form-control"
                                               placeholder="<?= TranslationOld::get('form_title') ?>"
                                               value="<?= request()->post('title', $menu_item->getTitle()) ?>"
                                               required>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="weight">
                                            <?= TranslationOld::get('form_weight') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" name="weight" id="weight" class="form-control"
                                               placeholder="<?= TranslationOld::get('form_weight') ?>"
                                               value="<?= request()->post('weight', $menu_item->getWeight()) ?>"
                                               required>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="/admin/structure/menu" class="btn btn-outline-danger float-left"
                                       data-toggle="tooltip" data-placement="top"
                                       title="<?= TranslationOld::get('reset_button') ?>">
                                        <?= TranslationOld::get('reset_button') ?>
                                    </a>

                                    <button type="submit" data-toggle="tooltip" data-placement="top"
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
                            <?= TranslationOld::get('menu_items_overview') ?>
                        </div>

                        <a href="/admin/structure/menu/item/create"
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
                        <?= $menu_items ?? '' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
