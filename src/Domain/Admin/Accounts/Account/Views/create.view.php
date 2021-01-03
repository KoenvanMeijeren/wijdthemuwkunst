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
?>
<form method="post" action="/admin/account/create/store">
    <?php echo CSRF::insertToken('/admin/account/create/store') ?>

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
                                <?php echo Translation::get('form_name') ?>
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="name" id="name"
                                   class="form-control form-control-user"
                                   placeholder="<?php echo Translation::get('form_name') ?>"
                                   value="<?php echo $request->post('name') ?>"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="email">
                                <?php echo Translation::get('form_email') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="email" id="email" class="form-control"
                                   placeholder="<?php echo Translation::get('form_email') ?>"
                                   value="<?php echo $request->post('email') ?>"
                                   required name="email">
                        </div>

                        <div class="form-group">
                            <label for="rights">
                                <?php echo Translation::get('form_rights') ?>
                                <span class="text-danger">*</span>
                            </label>

                            <select id="rights"
                                    class="form-control"
                                    name="rights"
                                    required>
                                <option value="0">
                                    <?php echo Translation::get('form_choose_rights') ?>
                                </option>
                                <option value="<?php echo User::ADMIN ?>"
                                    <?php echo (int) $request->post('rights') === User::ADMIN ? 'selected' : '' ?>>
                                    <?php echo Translation::get('form_rights_admin') ?>
                                </option>
                                <option value="<?php echo User::SUPER_ADMIN ?>"
                                    <?php echo (int) $request->post('rights') === User::SUPER_ADMIN ? 'selected' : '' ?>>
                                    <?php echo Translation::get('form_rights_super_admin') ?>
                                </option>
                                <option value="<?php echo User::DEVELOPER ?>"
                                    <?php echo (int) $request->post('rights') === User::DEVELOPER ? 'selected' : '' ?>>
                                    <?php echo Translation::get('form_rights_developer') ?>
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
                                <?php echo Translation::get('form_new_password') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password"
                                   name="password"
                                   id="newPassword"
                                   class="form-control"
                                   placeholder="<?php echo Translation::get('form_new_password') ?>"
                                   required autocomplete="false">
                        </div>

                        <div class="form-group">
                            <label for="confirmationPassword">
                                <?php echo Translation::get('form_confirmation_password') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="password"
                                   name="confirmationPassword"
                                   id="confirmationPassword"
                                   class="form-control"
                                   placeholder="<?php echo Translation::get('form_confirmation_password') ?>"
                                   required autocomplete="false">

                            <div id="password-feedback"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions-submit">
        <a href="/admin/account" class="btn btn-outline-primary float-left"
           data-toggle="tooltip" data-placement="top"
           title="<?php echo Translation::get('back_button') ?>">
            <i class="fas fa-arrow-left"></i>
            <?php echo Translation::get('back_button') ?>
        </a>

        <button type="submit" data-toggle="tooltip" data-placement="top"
                title="<?php echo Translation::get('save_button') ?>"
                class="btn btn-outline-success float-right">
            <?php echo Translation::get('save_button') ?>
            <i class="far fa-save"></i>
        </button>
    </div>

    <div class="clearfix"></div>
</form>
