<?php
declare(strict_types=1);

use App\Domain\Admin\Menu\Repositories\MenuRepository;
use Src\Core\Request;
use Src\Security\CSRF;
use Src\Translation\Translation;

$menuItem = new MenuRepository($menu_item ?? null);
$request = new Request();
?>
<?php if ($menuItem->get() === null) : ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Menu item toevoegen
                    </h4>
                </div>
                <div class="card-body">
                    <form method="post" action="/admin/menu/item/create/store">
                        <?= CSRF::insertToken('/admin/menu/item/create/store') ?>

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

                        <a href="/admin/menu"
                           class="btn btn-default-small float-left"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="<?= Translation::get('reset_button') ?>">
                            <?= Translation::get('reset_button') ?>
                        </a>

                        <button type="submit"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="<?= Translation::get('save_button') ?>"
                                class="btn btn-default-small float-right">
                            <?= Translation::get('save_button') ?>
                            <i class="far fa-save"></i>
                        </button>

                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php elseif ($menuItem->get() !== null) : ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Menu item '<?= $menuItem->getTitle() ?>' bewerken
                    </h4>
                </div>
                <div class="card-body">
                    <form method="post"
                          action="/admin/menu/item/edit/<?= $menuItem->getId() ?>/update">
                        <?= CSRF::insertToken("/admin/menu/item/edit/{$menuItem->getId()}/update") ?>

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

                        <a href="/admin/menu"
                           class="btn btn-default-small float-left"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="<?= Translation::get('reset_button') ?>">
                            <?= Translation::get('reset_button') ?>
                        </a>

                        <button type="submit"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="<?= Translation::get('save_button') ?>"
                                class="btn btn-default-small float-right">
                            <?= Translation::get('save_button') ?>
                            <i class="far fa-save"></i>
                        </button>

                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Menu overzicht
                </h4>
            </div>
            <div class="card-body">
                <?= $menu_items ?? '' ?>
            </div>
        </div>
    </div>
</div>
