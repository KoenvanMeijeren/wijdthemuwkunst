<?php

/**
 * @file
 */

use Components\Translation\TranslationOld;
use Domain\Admin\ContactForm\Repository\ContactFormRepository;
use Components\Security\CSRF;
use System\Request;

$request = new Request();
$amountMessages = count($messages ?? []);
?>
<div class="row">
    <div class="col-xl-12 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col-md-12 mr-2 mb-4">
                        <div class="text-lg font-weight-bold text-primary text-uppercase mb-1 float-left">
                            <?php if ($amountMessages === 1) : ?>
                                <?php echo $amountMessages . ' ' . TranslationOld::get('contact_request') ?>
                            <?php else : ?>
                                <?php echo $amountMessages . ' ' . TranslationOld::get('contact_requests') ?>
                            <?php endif; ?>
                        </div>

                        <form class="form-inline float-right" method="get"
                              action="/admin/content/contact-form/filter">
                            <div class="form-group mr-2">
                                <label for="unlimited-datepicker"></label>
                                <input type="text" name="date"
                                       autocomplete="off"
                                       placeholder="<?php echo TranslationOld::get('form_date') ?>"
                                       class="form-control" id="unlimited-datepicker"
                                       value="<?php echo $request->get('date') ?>">
                            </div>

                            <button class="btn btn-outline-primary">
                                <?php echo TranslationOld::get('filter_button') ?>
                            </button>

                            <?php if (isset($_GET['date'])) : ?>
                                <a href="/admin/content/contact-form"
                                   class="btn btn-outline-danger ml-3">
                                    <?php echo TranslationOld::get('reset_button') ?>
                                </a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <?php if ($amountMessages < 1) : ?>
                        <div class="col-md-12">
                            <p class="mt-2 font-weight-bold">
                                <?php echo TranslationOld::get('no_contact_requests_available') ?>
                            </p>
                        </div>
                    <?php endif; ?>

                    <?php if ($amountMessages > 0) : ?>
                        <div class="col-sm-4">
                            <div class="form-label-group">
                                <label for="searchLog" class="visually-hidden">
                                    <b><?php echo TranslationOld::get('form_search') ?></b>
                                </label>
                                <input type="text" id="searchLog"
                                       class="form-control mb-2"
                                       autocomplete="off" placeholder="Zoeken">
                            </div>

                            <div class="scrollbox-vertical h-500">
                                <div class="list-group overflow-hidden"
                                     id="list-tab" role="tablist">
                                    <?php $active = 'active';
                                    foreach (($messages ?? []) as $key => $singleMessage) :
                                      $message = new ContactFormRepository($singleMessage);
                                      $date = $message->convertDateTime()->toFormattedDate();
                                      ?>
                                        <a class="list-group-item list-group-item-action <?php echo $active ?>"
                                           id="list-<?php echo $key ?>-list"
                                           data-toggle="list"
                                           href="#list-<?php echo $key ?>" role="tab"
                                           aria-controls="<?php echo $key ?>">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <?php echo $message->getName() ?>
                                                </div>
                                                <div class="col-sm-6">
                                                    <?php echo $date ?> -
                                                    <?php echo $message->convertDateTime()->toTime() ?>
                                                </div>
                                            </div>
                                        </a>
                                        <?php $active = '';
                                    endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="tab-content" id="nav-tabContent">
                                <?php $active = 'active';
                                foreach (($messages ?? []) as $key => $singleMessage) :
                                  $message = new ContactFormRepository($singleMessage);
                                  ?>
                                    <div
                                        class="tab-pane fade show <?php echo $active ?>"
                                        id="list-<?php echo $key ?>" role="tabpanel"
                                        aria-labelledby="list-<?php echo $key ?>">
                                        <div class="row">
                                            <div class="col-md-11">
                                                <h3 class="mt-0 pt-0">
                                                    <?php echo ucfirst($message->convertDateTime()->toDateTime()) ?>
                                                </h3>
                                            </div>
                                            <div class="col-md-1 text-right">
                                                <form method="post"
                                                      action="/admin/content/contact-form/delete/<?php echo $message->getId() ?>">
                                                    <?php echo CSRF::insertToken('/admin/content/contact-form/delete/' . $message->getId()) ?>

                                                    <button type="submit"
                                                            class="btn border-0 btn-outline-danger"
                                                            onclick="return confirm('<?php echo TranslationOld::get('delete_contact_request_confirmation_message') ?>')"
                                                    >
                                                        <i class="fas fa-trash-alt"
                                                           aria-hidden="true"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>

                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?php echo TranslationOld::get('form_name') ?>:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?php echo $message->getName() ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?php echo TranslationOld::get('form_email') ?>:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?php echo $message->getEmail() ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        <?php echo TranslationOld::get('form_message') ?>:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?php echo $message->getMessage() ?>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <?php $active = '';
                                endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
