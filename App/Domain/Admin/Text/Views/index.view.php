<?php

/**
 * @file
 */

declare(strict_types=1);

use App\Domain\Admin\Text\Repositories\TextRepository;
use Domain\Admin\Accounts\User\Models\User;
use Src\Core\Request;
use Src\Security\CSRF;
use Src\Translation\Translation;

$text = new TextRepository($text ?? NULL);
$request = new Request();
$user = new User();

$createText = $createText ?? FALSE;
$disabled = $user->getRights() === User::DEVELOPER ? '' : 'disabled';
?>
<?php if ($createText && $user->getRights() === User::DEVELOPER && $text->get() === NULL) : ?>
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 mr-2 mb-4">
                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                <?php echo Translation::get('add_text_title') ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="/admin/configuration/texts/text/create/store">
                                <?php echo CSRF::insertToken('/admin/configuration/texts/text/create/store') ?>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="key">
                                            <?php echo Translation::get('form_key') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="key"
                                               id="key"
                                               class="form-control"
                                               placeholder="<?php echo Translation::get('form_key') ?>"
                                               value="<?php echo $request->post('key') ?>"
                                               required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="value">
                                            <?php echo Translation::get('form_value') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="value"
                                               id="value"
                                               class="form-control"
                                               placeholder="<?php echo Translation::get('form_value') ?>"
                                               value="<?php echo $request->post('value') ?>"
                                               required>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="/admin/configuration/texts"
                                       class="btn btn-outline-danger float-left"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="<?php echo Translation::get('reset_button') ?>">
                                        <?php echo Translation::get('reset_button') ?>
                                    </a>

                                    <button type="submit"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="<?php echo Translation::get('save_button') ?>"
                                            class="btn btn-outline-success float-right">
                                        <?php echo Translation::get('save_button') ?>
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
<?php elseif ($text->get() !== NULL) : ?>
    <div class="row">
        <div class="col-xl-12 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-md-12 mr-2 mb-4">
                            <div class="text-lg font-weight-bold text-primary text-uppercase mb-1">
                                <?php echo sprintf(
                                Translation::get('edit_text_title'),
                                $text->getReadableKey()
                                ) ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <form method="post"
                                  action="/admin/configuration/texts/text/edit/<?php echo $text->getId() ?>/update">
                                <?php echo CSRF::insertToken("/admin/configuration/texts/text/edit/{$text->getId()}/update") ?>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="key">
                                            <?php echo Translation::get('form_key') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="key"
                                               id="key"
                                               class="form-control"
                                            <?php echo $disabled ?>
                                               placeholder="<?php echo Translation::get('form_key') ?>"
                                               value="<?php echo $request->post(
                                                'key',
                                                $text->getReadableKey()
                                                      ) ?>"
                                               required>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="value">
                                            <?php echo Translation::get('form_value') ?>
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="value"
                                               id="value"
                                               class="form-control"
                                               placeholder="<?php echo Translation::get('form_value') ?>"
                                               value="<?php echo $request->post(
                                                   'value',
                                                   $text->getValue()
                                                      ) ?>"
                                               required>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <a href="/admin/configuration/texts"
                                       class="btn btn-outline-danger float-left"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="<?php echo Translation::get('reset_button') ?>">
                                        <?php echo Translation::get('reset_button') ?>
                                    </a>

                                    <button type="submit"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="<?php echo Translation::get('save_button') ?>"
                                            class="btn btn-outline-success float-right">
                                        <?php echo Translation::get('save_button') ?>
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
                            <?php echo Translation::get('texts_overview_title') ?>
                        </div>

                        <a href="/admin/configuration/texts/text/create"
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
                        <?php echo $texts ?? '' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
