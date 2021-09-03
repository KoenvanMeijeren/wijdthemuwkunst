<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\Security\CSRF;
use Components\Translation\TranslationOld;
use Modules\User\Entity\AccountInterface;

$current_user = user();
/** @var \Modules\User\Entity\AccountInterface $entity */
$entity = $account ?? NULL;
$disabled = $current_user->id() === $entity->id() ? 'disabled' : '';
$rights = (int) request()->post('rights');
$rights = $rights !== 0 ? $rights : $entity->getRights();
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
                          action="/admin/account/edit/<?= $entity->id() ?>/store/data">
                        <?= CSRF::insertToken('/admin/account/edit/' . $entity->id() . '/store/data') ?>

                        <div class="form-group">
                            <label for="name">
                                <?= TranslationOld::get('form_name') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="name" id="name"
                                   class="form-control"
                                   placeholder="<?= TranslationOld::get('form_name') ?>"
                                   value="<?= request()->post('name', $entity->getName()) ?>"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="rights">
                                <?= TranslationOld::get('form_rights') ?>
                                <span class="text-danger">*</span>
                            </label>

                            <select id="rights" class="form-control"
                                    name="rights"
                                <?= $disabled ?> required>
                                <option value="0">
                                    <?= TranslationOld::get('form_choose_rights') ?>
                                </option>
                                <option value="<?= AccountInterface::ADMIN ?>"
                                    <?= $rights === AccountInterface::ADMIN ? 'selected' : '' ?>>
                                    <?= TranslationOld::get('form_rights_admin') ?>
                                </option>
                                <option value="<?= AccountInterface::SUPER_ADMIN ?>"
                                    <?= $rights === AccountInterface::SUPER_ADMIN ? 'selected' : '' ?>>
                                    <?= TranslationOld::get('form_rights_super_admin') ?>
                                </option>
                                <option value="<?= AccountInterface::DEVELOPER ?>"
                                    <?= $rights === AccountInterface::DEVELOPER ? 'selected' : '' ?>>
                                    <?= TranslationOld::get('form_rights_developer') ?>
                                </option>
                            </select>
                        </div>

                        <div class="mt-3">
                            <a href="/admin/account"
                               class="btn btn-outline-danger float-left"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="<?= TranslationOld::get('back_button') ?>">
                                <i class="fas fa-arrow-left"></i>
                                <?= TranslationOld::get('back_button') ?>
                            </a>

                            <button type="submit"
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
                              action="/admin/account/edit/<?= $entity->id() ?>/store/email">
                            <?= CSRF::insertToken('/admin/account/edit/' . $entity->id() . '/store/email') ?>

                            <div class="form-group">
                                <label for="email">
                                    <?= TranslationOld::get('form_email') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" id="email"
                                       name="email"
                                       class="form-control"
                                       placeholder="<?= TranslationOld::get('form_email') ?>"
                                       value="<?= request()->post('email') !== '' ?
                                           request()->post('email') : $entity->getEmail() ?>"
                                       required>
                            </div>

                            <div class="mt-3">
                                <a href="/admin/account"
                                   class="btn btn-outline-danger float-left"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title="<?= TranslationOld::get('back_button') ?>">
                                    <i class="fas fa-arrow-left"></i>
                                    <?= TranslationOld::get('back_button') ?>
                                </a>

                                <button type="submit"
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
                          action="/admin/account/edit/<?= $entity->id() ?>/store/password">
                        <?= CSRF::insertToken('/admin/account/edit/' . $entity->id() . '/store/password') ?>

                        <div class="form-group">
                            <label for="newPassword">
                                <?= TranslationOld::get('form_new_password') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password"
                                   name="password"
                                   id="newPassword"
                                   class="form-control"
                                   placeholder="<?= TranslationOld::get('form_new_password') ?>"
                                   required autocomplete="false">
                        </div>

                        <div class="form-group">
                            <label for="confirmationPassword">
                                <?= TranslationOld::get('form_confirmation_password') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password"
                                   name="confirmationPassword"
                                   id="confirmationPassword"
                                   class="form-control"
                                   placeholder="<?= TranslationOld::get('form_confirmation_password') ?>"
                                   required autocomplete="false">

                            <div id="password-feedback"></div>
                        </div>

                        <div class="mt-3">
                            <a href="/admin/account"
                               class="btn btn-outline-danger float-left"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="<?= TranslationOld::get('back_button') ?>">
                                <i class="fas fa-arrow-left"></i>
                                <?= TranslationOld::get('back_button') ?>
                            </a>

                            <button type="submit"
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
                        <?php if ($entity->isBlocked()) : ?>
                            <div class="card-text mb-4">
                                <h4 class="card-title">
                                    Account is geblokkeerd
                                </h4>
                            </div>

                            <form method="post"
                                  action="/admin/account/unblock/<?= $entity->id() ?>">
                                <?= CSRF::insertToken("/admin/account/unblock/{$entity->id()}") ?>
                                <button type="submit"
                                        class="btn btn-outline-success">
                                    <?= TranslationOld::get('unblock_button') ?>
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
                                  action="/admin/account/block/<?= $entity->id() ?>">
                                <?= CSRF::insertToken("/admin/account/block/{$entity->id()}") ?>

                                <button type="submit"
                                        class="btn btn-outline-danger">
                                    <?= TranslationOld::get('block_button') ?>
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
