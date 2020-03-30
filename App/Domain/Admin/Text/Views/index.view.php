<?php
declare(strict_types=1);

use App\Domain\Admin\Text\Repositories\TextRepository;
use Domain\Admin\Accounts\User\Models\User;
use Src\Core\Request;
use Src\Security\CSRF;
use Src\Translation\Translation;

$text = new TextRepository($text ?? null);
$request = new Request();
$user = new User();

$disabled = $user->getRights() === User::DEVELOPER ? '' : 'disabled';
?>
<?php if ($user->getRights() === User::DEVELOPER && $text->get() === null) : ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Tekst toevoegen
                    </h4>
                </div>
                <div class="card-body">
                    <form method="post" action="/admin/text/create/store">
                        <?= CSRF::insertToken('/admin/text/create/store') ?>

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

                        <a href="/admin/texts"
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
<?php elseif ($text->get() !== null) : ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        Tekst '<?= $text->getReadableKey() ?>' bewerken
                    </h4>
                </div>
                <div class="card-body">
                    <form method="post"
                          action="/admin/text/edit/<?= $text->getId() ?>/update">
                        <?= CSRF::insertToken("/admin/text/edit/{$text->getId()}/update") ?>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="key">
                                    <?= Translation::get('form_key') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="key"
                                       id="key"
                                       class="form-control"
                                    <?= $disabled ?>
                                       placeholder="<?= Translation::get('form_key') ?>"
                                       value="<?= $request->post(
                                           'key',
                                           $text->getReadableKey()
                                       ) ?>"
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
                                       value="<?= $request->post(
                                           'value',
                                           $text->getValue()
                                       ) ?>"
                                       required>
                            </div>
                        </div>

                        <a href="/admin/texts"
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
                    Teksten overzicht
                </h4>
            </div>
            <div class="card-body">
                <?= $texts ?? '' ?>
            </div>
        </div>
    </div>
</div>