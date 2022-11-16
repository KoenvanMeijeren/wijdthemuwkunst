<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\Security\CSRF;
use Components\Translation\TranslationOld;

/** @var \Modules\User\Entity\AccountInterface $entity */
$entity = $account ?? NULL;
?>
<div class="row">
  <div class="col-md-6">
    <div class="card shadow mb-4">
      <!-- Card Header - Accordion -->
      <a href="#collapseDataForm" class="d-block card-header py-3"
         data-toggle="collapse" role="button" aria-expanded="true"
         aria-controls="collapseDataForm">
        <h6 class="m-0 font-weight-bold text-primary">
          <?= TranslationOld::get('admin_edit_regular_data_account_title') ?>
        </h6>
      </a>
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapseDataForm">
        <div class="card-body">
          <form method="post" action="<?= urlFromRoute('entity.user.saveData') ?>">
            <?= CSRF::insertToken('/admin/user/account/store/data') ?>

            <div class="form-group">
              <label for="name">
                <?= TranslationOld::get('form_name') ?>
                <span class="text-danger">*</span>
              </label>

              <input type="text" name="name" id="name"
                     class="form-control form-control-user"
                     placeholder="<?= TranslationOld::get('form_name') ?>"
                     value="<?= request()->post('name') !== '' ?
                       request()->post('name') : $entity->getName() ?>"
                     required>
            </div>

            <div class="form-group">
              <label for="email">
                <?= TranslationOld::get('form_email') ?>
                <span class="text-danger">*</span>
              </label>
              <input type="email" id="email"
                     class="form-control"
                     placeholder="<?= TranslationOld::get('form_email') ?>"
                     value="<?= $entity->getEmail() ?>"
                     disabled
                     required>
            </div>

            <button type="submit"
                    class="btn btn-outline-primary float-right">
              <?= TranslationOld::get('save_button') ?>
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
          <?= TranslationOld::get('admin_edit_password_account_title') ?>
        </h6>
      </a>
      <!-- Card Content - Collapse -->
      <div class="collapse show" id="collapsePasswordForm">
        <div class="card-body">
          <form method="post" action="<?= urlFromRoute('entity.user.savePassword') ?>">
            <?= CSRF::insertToken(urlFromRoute('entity.user.savePassword')) ?>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label for="currentPassword">
                    <?= TranslationOld::get('form_current_password') ?>
                    <span class="text-danger">*</span>
                  </label>
                  <input type="password" name="currentPassword"
                         id="currentPassword" class="form-control"
                         placeholder="<?= TranslationOld::get('form_current_password') ?>"
                         required autocomplete="true">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="newPassword">
                    <?= TranslationOld::get('form_new_password') ?>
                    <span class="text-danger">*</span>
                  </label>
                  <input type="password" name="newPassword"
                         id="newPassword" class="form-control"
                         placeholder="<?= TranslationOld::get('form_new_password') ?>"
                         required autocomplete="false">
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="confirmationPassword">
                    <?= TranslationOld::get('form_confirmation_password') ?>
                    <span class="text-danger">*</span>
                  </label>
                  <input type="password" name="confirmationPassword"
                         id="confirmationPassword" class="form-control"
                         placeholder="<?= TranslationOld::get('form_confirmation_password') ?>"
                         required autocomplete="false">

                  <div id="password-feedback"></div>
                </div>
              </div>
            </div>

            <button type="submit"
                    class="btn btn-outline-primary float-right">
              <?= TranslationOld::get('save_button') ?>
              <i class="far fa-save"></i>
            </button>

            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
