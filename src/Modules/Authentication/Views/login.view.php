<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\Resource\Resource;
use Components\Security\CSRF;
use Components\Translation\TranslationOld;

?>
<div class="row justify-content-center">
    <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">
                                    <?= TranslationOld::get('login_page_title') ?>
                                </h1>

                                <?php Resource::loadFlashMessage(); ?>
                            </div>

                            <form class="user" method="post" action="/admin/login">
                                <?= CSRF::insertToken('/admin/login') ?>

                                <div class="form-group">
                                    <label for="email">
                                        <b>
                                            <?= TranslationOld::get('form_email') ?>
                                            <span>*</span>
                                        </b>
                                    </label>
                                    <input class="form-control form-control-user" type="email" id="email"
                                           name="email" required autofocus="autofocus"
                                           placeholder="<?= TranslationOld::get('form_email_placeholder') ?>">
                                </div>

                                <div class="form-group">
                                    <label for="password">
                                        <b>
                                            <?= TranslationOld::get('form_password') ?>
                                            <span>*</span>
                                        </b>
                                    </label>
                                    <input class="form-control form-control-user" type="password" id="password"
                                           name="password" required
                                           placeholder="<?= TranslationOld::get('form_password_placeholder') ?>">
                                </div>

                                <button class="btn btn-primary btn-user btn-block" type="submit">
                                    <?= TranslationOld::get('login_button') ?>
                                    <i class="fas fa-sign-in-alt"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
