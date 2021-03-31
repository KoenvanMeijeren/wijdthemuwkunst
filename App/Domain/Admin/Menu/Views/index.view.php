<?php
declare(strict_types=1);

use App\Domain\Admin\Menu\Repositories\MenuRepository;
use Src\Core\Request;
use Src\Security\CSRF;
use Src\Translation\Translation;

$menuItem = new MenuRepository($menu_item ?? null);
$request = new Request();
$createMenuItem = $create_menu_item ?? false;
?>
<?php if ($createMenuItem && $menuItem->get() === null) : ?>
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 mr-2 mb-4">
                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                <?= Translation::get('add_menu_item_title') ?>
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
                                            <?= Translation::get('form_page_slug') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="slug"
                                               id="slug"
                                               class="form-control"
                                               placeholder="<?= Translation::get('form_page_slug') ?>"
                                               value="<?= $request->post('slug') ?>"
                                               required>
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="title">
                                            <?= Translation::get('form_title') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="title"
                                               id="title"
                                               class="form-control"
                                               placeholder="<?= Translation::get('form_title') ?>"
                                               value="<?= $request->post('title') ?>"
                                               required>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="weight">
                                            <?= Translation::get('form_weight') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" name="weight"
                                               id="weight"
                                               class="form-control"
                                               placeholder="<?= Translation::get('form_weight') ?>"
                                               value="<?= $request->post('weight') ?>"
                                               required>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="/admin/structure/menu"
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
<?php elseif ($menuItem->get() !== null) : ?>
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 mr-2 mb-4">
                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                <?= sprintf(
                                    Translation::get('edit_menu_item_title'),
                                    $menuItem->getTitle()
                                ) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form method="post"
                                  action="/admin/structure/menu/item/edit/<?= $menuItem->getId() ?>/update">
                                <?= CSRF::insertToken("/admin/structure/menu/item/edit/{$menuItem->getId()}/update") ?>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <label for="slug">
                                            <?= Translation::get('form_page_slug') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="slug"
                                               id="slug"
                                               class="form-control"
                                               placeholder="<?= Translation::get('form_page_slug') ?>"
                                               value="<?= $request->post('slug', $menuItem->getSlug()) ?>"
                                               required>
                                    </div>
                                    <div class="col-sm-5">
                                        <label for="title">
                                            <?= Translation::get('form_title') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="title"
                                               id="title"
                                               class="form-control"
                                               placeholder="<?= Translation::get('form_title') ?>"
                                               value="<?= $request->post('title', $menuItem->getTitle()) ?>"
                                               required>
                                    </div>
                                    <div class="col-sm-2">
                                        <label for="weight">
                                            <?= Translation::get('form_weight') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" name="weight"
                                               id="weight"
                                               class="form-control"
                                               placeholder="<?= Translation::get('form_weight') ?>"
                                               value="<?= $request->post('weight', (string)$menuItem->getWeight()) ?>"
                                               required>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="/admin/structure/menu"
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
                            <?= Translation::get('menu_items_overview') ?>
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