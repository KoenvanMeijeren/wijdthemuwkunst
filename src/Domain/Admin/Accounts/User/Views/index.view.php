<?php

/**
 * @file
 */

declare(strict_types=1);

use Domain\Admin\Accounts\Repositories\AccountRepository;
use System\Request;
use Src\Security\CSRF;
use Src\Translation\Translation;

$request = new Request();
$account = new AccountRepository($account ?? NULL);
?>
<div class="row">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Accordion -->
            <a href="#collapseDataForm" class="d-block card-header py-3"
               data-toggle="collapse" role="button" aria-expanded="true"
               aria-controls="collapseDataForm">
                <h6 class="m-0 font-weight-bold text-primary">
                    <?php echo Translation::get('admin_edit_regular_data_account_title') ?>
                </h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapseDataForm">
                <div class="card-body">
                    <form method="post" action="/admin/user/account/store/data">
                        <?php echo CSRF::insertToken('/admin/user/account/store/data') ?>

                        <div class="form-group">
                            <label for="name">
                                <?php echo Translation::get('form_name') ?>
                                <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="name" id="name"
                                   class="form-control form-control-user"
                                   placeholder="<?php echo Translation::get('form_name') ?>"
                                   value="<?php echo $request->post('name') !== '' ?
                                       $request->post('name') : $account->getName() ?>"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="email">
                                <?php echo Translation::get('form_email') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="email" id="email"
                                   class="form-control"
                                   placeholder="<?php echo Translation::get('form_email') ?>"
                                   value="<?php echo $account->getEmail() ?>"
                                   disabled
                                   required>
                        </div>

                        <button type="submit"
                                class="btn btn-outline-primary float-right">
                            <?php echo Translation::get('save_button') ?>
                            <i class="far fa-save"></i>
                        </button>

                        <div class="clearfix"></div>
                    </form>
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
                    <?php echo Translation::get('admin_edit_password_account_title') ?>
                </h6>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="collapsePasswordForm">
                <div class="card-body">
                    <form method="post"
                          action="/admin/user/account/store/password">
                        <?php echo CSRF::insertToken('/admin/user/account/store/password') ?>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="currentPassword">
                                        <?php echo Translation::get('form_current_password') ?>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" name="currentPassword"
                                           id="currentPassword" class="form-control"
                                           placeholder="<?php echo Translation::get('form_current_password') ?>"
                                           required autocomplete="true">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="newPassword">
                                        <?php echo Translation::get('form_new_password') ?>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" name="newPassword"
                                           id="newPassword" class="form-control"
                                           placeholder="<?php echo Translation::get('form_new_password') ?>"
                                           required autocomplete="false">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="confirmationPassword">
                                        <?php echo Translation::get('form_confirmation_password') ?>
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="password" name="confirmationPassword"
                                           id="confirmationPassword" class="form-control"
                                           placeholder="<?php echo Translation::get('form_confirmation_password') ?>"
                                           required autocomplete="false">

                                    <div id="password-feedback"></div>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                                class="btn btn-outline-primary float-right">
                            <?php echo Translation::get('save_button') ?>
                            <i class="far fa-save"></i>
                        </button>

                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
