<?php
declare(strict_types=1);

use Domain\Admin\Accounts\Repositories\AccountRepository;
use Domain\Admin\Accounts\User\Models\User;
use Src\Core\Request;
use Src\Security\CSRF;
use Src\Translation\Translation;

$request = new Request();
$user = new User();
$account = new AccountRepository($account ?? null);
$disabled = $user->getId() === $account->getId() ? 'disabled' : '';
$rights = (int)$request->post('rights');
$rights = $rights !== 0 ? $rights : $account->getRights();
?>

<div class="row">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseDataForm" class="d-block card-header py-3"
               data-toggle="collapse" role="button" aria-expanded="true"
               aria-controls="collapseDataForm">
                <h6 class="m-0 font-weight-bold text-primary">
                    Gegevens
                </h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseDataForm">
                <div class="card-body">
                    <form method="post"
                          action="/admin/account/edit/<?= $account->getId() ?>/store/data">
                        <?= CSRF::insertToken('/admin/account/edit/' . $account->getId() . '/store/data') ?>

                        <div class="form-group">
                            <label for="name">
                                <?= Translation::get('form_name') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" id="name"
                                   class="form-control"
                                   placeholder="<?= Translation::get('form_name') ?>"
                                   value="<?= $request->post('name', $account->getName()) ?>"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="rights">
                                <?= Translation::get('form_rights') ?>
                                <span class="text-danger">*</span>
                            </label>

                            <select id="rights" class="form-control"
                                    name="rights"
                                <?= $disabled ?> required>
                                <option value="0">
                                    <?= Translation::get('form_choose_rights') ?>
                                </option>
                                <option value="<?= User::ADMIN ?>"
                                    <?= $rights === User::ADMIN ? 'selected' : '' ?>>
                                    <?= Translation::get('form_rights_admin') ?>
                                </option>
                                <option value="<?= User::SUPER_ADMIN ?>"
                                    <?= $rights === User::SUPER_ADMIN ? 'selected' : '' ?>>
                                    <?= Translation::get('form_rights_super_admin') ?>
                                </option>
                                <option value="<?= User::DEVELOPER ?>"
                                    <?= $rights === User::DEVELOPER ? 'selected' : '' ?>>
                                    <?= Translation::get('form_rights_developer') ?>
                                </option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <a href="/admin/account"
                               class="btn btn-outline-danger float-left"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="<?= Translation::get('back_button') ?>">
                                <i class="fas fa-arrow-left"></i>
                                <?= Translation::get('back_button') ?>
                            </a>

                            <button type="submit"
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

    <?php if ($disabled === '') : ?>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseEmailForm" class="d-block card-header py-3"
                   data-toggle="collapse" role="button" aria-expanded="true"
                   aria-controls="collapseEmailForm">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Email
                    </h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseEmailForm">
                    <div class="card-body">
                        <form method="post"
                              action="/admin/account/edit/<?= $account->getId() ?>/store/email">
                            <?= CSRF::insertToken('/admin/account/edit/' . $account->getId() . '/store/email') ?>

                            <div class="form-group">
                                <label for="email">
                                    <?= Translation::get('form_email') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" id="email"
                                       name="email"
                                       class="form-control"
                                       placeholder="<?= Translation::get('form_email') ?>"
                                       value="<?= $request->post('email') !== '' ?
                                           $request->post('email') : $account->getEmail() ?>"
                                       required>
                            </div>

                            <div class="mt-3">
                                <a href="/admin/account"
                                   class="btn btn-outline-danger float-left"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title="<?= Translation::get('back_button') ?>">
                                    <i class="fas fa-arrow-left"></i>
                                    <?= Translation::get('back_button') ?>
                                </a>

                                <button type="submit"
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
    <?php endif; ?>

    <div class="col-md-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapsePasswordForm" class="d-block card-header py-3"
               data-toggle="collapse" role="button" aria-expanded="true"
               aria-controls="collapsePasswordForm">
                <h6 class="m-0 font-weight-bold text-primary">
                    Wachtwoord
                </h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapsePasswordForm">
                <div class="card-body">
                    <form method="post"
                          action="/admin/account/edit/<?= $account->getId() ?>/store/password">
                        <?= CSRF::insertToken('/admin/account/edit/' . $account->getId() . '/store/password') ?>

                        <div class="form-group">
                            <label for="newPassword">
                                <?= Translation::get('form_new_password') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password"
                                   name="password"
                                   id="newPassword"
                                   class="form-control"
                                   placeholder="<?= Translation::get('form_new_password') ?>"
                                   required autocomplete="false">
                        </div>

                        <div class="form-group">
                            <label for="confirmationPassword">
                                <?= Translation::get('form_confirmation_password') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password"
                                   name="confirmationPassword"
                                   id="confirmationPassword"
                                   class="form-control"
                                   placeholder="<?= Translation::get('form_confirmation_password') ?>"
                                   required autocomplete="false">

                            <div id="password-feedback"></div>
                        </div>

                        <div class="mt-3">
                            <a href="/admin/account"
                               class="btn btn-outline-danger float-left"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="<?= Translation::get('back_button') ?>">
                                <i class="fas fa-arrow-left"></i>
                                <?= Translation::get('back_button') ?>
                            </a>

                            <button type="submit"
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

    <?php if ($disabled === '') : ?>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseBlockAccountForm" class="d-block card-header py-3"
                   data-toggle="collapse" role="button" aria-expanded="true"
                   aria-controls="collapseBlockAccountForm">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Blokkeren
                    </h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseBlockAccountForm">
                    <div class="card-body">
                        <?php if ($account->isBlocked()) : ?>
                            <div class="card-text mb-4">
                                <h4 class="card-title">
                                    Account is geblokkeerd
                                </h4>
                            </div>

                            <form method="post"
                                  action="/admin/account/unblock/<?= $account->getId() ?>">
                                <?= CSRF::insertToken("/admin/account/unblock/{$account->getId()}") ?>
                                <button type="submit"
                                        class="btn btn-outline-success">
                                    <?= Translation::get('unblock_button') ?>
                                    <i class="far fa-save"></i>
                                </button>
                                <div class="clearfix"></div>
                            </form>
                        <?php else : ?>
                            <div class="card-text mb-4">
                                <h4 class="card-title">
                                    Account blokkeren?
                                </h4>
                            </div>

                            <form method="post"
                                  action="/admin/account/block/<?= $account->getId() ?>">
                                <?= CSRF::insertToken("/admin/account/block/{$account->getId()}") ?>

                                <button type="submit"
                                        class="btn btn-outline-danger">
                                    <?= Translation::get('block_button') ?>
                                    <i class="far fa-save"></i>
                                </button>
                                <div class="clearfix"></div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>
