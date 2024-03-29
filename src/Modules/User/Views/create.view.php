<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\Route\RouteRights;
use Components\Security\CSRF;
use Components\Translation\TranslationOld;

?>
<form method="post" action="<?= urlFromRoute('entity.account.save') ?>">
    <?= CSRF::insertToken(urlFromRoute('entity.account.save')) ?>

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
                        <div class="form-group">
                            <label for="name">
                                <?= TranslationOld::get('form_name') ?>
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="name" id="name" class="form-control form-control-user"
                                   placeholder="<?= TranslationOld::get('form_name') ?>"
                                   value="<?= request()->post('name') ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="email">
                                <?= TranslationOld::get('form_email') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="email" id="email" class="form-control"
                                   placeholder="<?= TranslationOld::get('form_email') ?>"
                                   value="<?= request()->post('email') ?>"
                                   required name="email">
                        </div>

                        <div class="form-group">
                            <label for="rights">
                                <?= TranslationOld::get('form_rights') ?>
                                <span class="text-danger">*</span>
                            </label>

                            <select id="rights" class="form-control" name="rights" required>
                                <option value="<?= RouteRights::GUEST->value ?>">
                                    <?= TranslationOld::get('form_choose_rights') ?>
                                </option>
                                <option value="<?= RouteRights::ADMIN->value ?>"
                                    <?= (int) request()->post('rights') === RouteRights::ADMIN->value ? 'selected' : '' ?>>
                                    <?= TranslationOld::get('form_rights_admin') ?>
                                </option>
                                <option value="<?= RouteRights::SUPER_ADMIN->value ?>"
                                    <?= (int) request()->post('rights') === RouteRights::SUPER_ADMIN->value ? 'selected' : '' ?>>
                                    <?= TranslationOld::get('form_rights_super_admin') ?>
                                </option>
                                <option value="<?= RouteRights::DEVELOPER->value ?>"
                                    <?= (int) request()->post('rights') === RouteRights::DEVELOPER->value ? 'selected' : '' ?>>
                                    <?= TranslationOld::get('form_rights_developer') ?>
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
                        <div class="form-group">
                            <label for="newPassword">
                                <?= TranslationOld::get('form_new_password') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password" name="password" id="newPassword" class="form-control"
                                   placeholder="<?= TranslationOld::get('form_new_password') ?>"
                                   required autocomplete="false">
                        </div>

                        <div class="form-group">
                            <label for="confirmationPassword">
                                <?= TranslationOld::get('form_confirmation_password') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password" name="confirmationPassword" id="confirmationPassword"
                                   class="form-control" placeholder="<?= TranslationOld::get('form_confirmation_password') ?>"
                                   required autocomplete="false">

                            <div id="password-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions-submit">
        <a href="<?= urlFromRoute('entity.account.collection') ?>" class="btn btn-outline-primary float-left"
           data-toggle="tooltip" data-placement="top"
           title="<?= TranslationOld::get('back_button') ?>">
            <i class="fas fa-arrow-left"></i>
            <?= TranslationOld::get('back_button') ?>
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
