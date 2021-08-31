<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\Translation\TranslationOld;
use Components\Security\CSRF;

/** @var \Modules\Event\Entity\EventInterface $event */
$event = $event ?? NULL;

$action = '/admin/content/events/event/create/store';
$removeBannerAction = '';
$removeThumbnailAction = '';
$publishActionsVisible = FALSE;
if ($event?->id() !== 0) {
  $publishActionsVisible = TRUE;
  $action = '/admin/content/events/event/edit/' . $event?->id() . '/store';
  $removeThumbnailAction = '/admin/content/events/event/edit/' . $event?->id() . '/remove/thumbnail';
  $removeBannerAction = '/admin/content/events/event/edit/' . $event?->id() . '/remove/banner';
}

$collapseEventDetails = 'show';
if (!empty($event?->getTitle()) && !empty($event?->getLocation()) && !empty($event?->getDateTime()) && !empty($event?->getTime())) {
  $collapseEventDetails = '';
}

$collapseEventPictures = 'show';
if (!empty($event?->getThumbnail()) || !empty($event?->getBanner())) {
  $collapseEventPictures = '';
}
?>
<div class="form-actions-container">
    <?php if ($publishActionsVisible) : ?>
        <?php if ($event?->isPublished()) : ?>
            <form method="post" class="form-actions"
                  action="/admin/content/events/event/unpublish/<?= $event?->id() ?>">
                <?= CSRF::insertToken('/admin/content/events/event/unpublish/' . $event?->id()) ?>

                <button type="submit" class="btn btn-outline-danger">
                    <?= TranslationOld::get('unpublish_button') ?>
                </button>
            </form>
        <?php else : ?>
            <form method="post" class="form-actions"
                  action="/admin/content/events/event/publish/<?= $event?->id() ?>">
                <?= CSRF::insertToken('/admin/content/events/event/publish/' . $event?->id()) ?>

                <button type="submit" class="btn btn-outline-success">
                    <?= TranslationOld::get('publish_button') ?>
                </button>
            </form>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($removeThumbnailAction !== '' && $event?->getThumbnail() !== '') : ?>
        <form method="post" class="form-actions"
              action="<?= $removeThumbnailAction ?>">
            <?= CSRF::insertToken($removeThumbnailAction) ?>

            <button type="submit"
                    name="remove-thumbnail"
                    class="btn btn-outline-danger">
                <?= TranslationOld::get('delete_thumbnail_button') ?>
            </button>
        </form>
    <?php endif; ?>

    <?php if ($removeBannerAction !== '' && $event?->getBanner() !== '') : ?>
        <form method="post"
              action="<?= $removeBannerAction ?>">
            <?= CSRF::insertToken($removeBannerAction) ?>
            <button type="submit"
                    name="delete-banner"
                    class="btn btn-outline-danger">
                <?= TranslationOld::get('delete_banner_button') ?>
            </button>
        </form>
    <?php endif; ?>
</div>

<form method="post" action="<?= $action ?>">
    <?= CSRF::insertToken($action) ?>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <a href="#collapseEventDetails" class="d-block card-header py-3"
                   data-toggle="collapse" role="button" aria-expanded="true"
                   aria-controls="collapseEventDetails">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Concert gegevens
                    </h6>
                </a>
                <div class="collapse <?= $collapseEventDetails ?>"
                     id="collapseEventDetails">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">
                                <?= TranslationOld::get('form_title') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" id="title" class="form-control"
                                   placeholder="<?= TranslationOld::get('form_title') ?>"
                                   value="<?= request()->post('title', $event?->getTitle()) ?>"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="location">
                                <?= TranslationOld::get('form_location') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="location" id="location" class="form-control"
                                   placeholder="<?= TranslationOld::get('form_location') ?>"
                                   value="<?= request()->post('location', $event?->getLocation()) ?>"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="datepicker">
                                <?= TranslationOld::get('form_date') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="date" id="datepicker" class="form-control"
                                   value="<?= request()->post('date', $event?->getDate()) ?>"
                                   required autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label for="timepicker">
                                <?= TranslationOld::get('form_time') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="time" id="timepicker" class="form-control"
                                   placeholder="<?= TranslationOld::get('form_time') ?>"
                                   value="<?= request()->post('time', $event?->getTime()) ?>"
                                   required autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <a href="#collapseEventPictures" class="d-block card-header py-3"
                   data-toggle="collapse" role="button" aria-expanded="true"
                   aria-controls="collapseEventPictures">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Concert foto's
                    </h6>
                </a>
                <div class="collapse <?= $collapseEventPictures ?>"
                     id="collapseEventPictures">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="mb-2">
                                        <?= TranslationOld::get('form_thumbnail_size') ?>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputThumbnail">
                                        <label class="custom-file-label" for="inputThumbnail">
                                            Kies foto
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <img class="img-thumbnail" src="<?= $event?->getThumbnail() ?>"
                                         id="thumbnailOutput" alt="Thumbnail">
                                    <input type="hidden" name="thumbnail" id="thumbnailInputOutput">
                                </div>

                                <div class="thumbnailProgress progress">
                                    <div class="thumbnail-progress-bar progress-bar progress-bar-striped progress-bar-animated"
                                        role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%
                                    </div>
                                </div>

                                <div class="thumbnailAlert alert" role="alert"></div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="mb-2">
                                        <?= TranslationOld::get('form_banner_size') ?>
                                    </div>

                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputBanner">
                                        <label class="custom-file-label" for="inputBanner">
                                            Kies foto
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <img class="img-thumbnail" src="<?= $event?->getBanner() ?>"
                                         id="bannerOutput" alt="Banner">
                                    <input type="hidden" name="banner" id="bannerInputOutput">
                                </div>

                                <div class="form-group">
                                    <div class="bannerProgress progress">
                                        <div class="banner-progress-bar progress-bar progress-bar-striped progress-bar-animated"
                                            role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                            aria-valuemax="100">0%
                                        </div>
                                    </div>

                                    <div class="bannerAlert alert"
                                         role="alert"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <a href="#collapseEventContent" class="d-block card-header py-3"
                   data-toggle="collapse" role="button" aria-expanded="true"
                   aria-controls="collapseEventContent">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Concert content
                    </h6>
                </a>
                <div class="collapse show" id="collapseEventContent">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tinymce" class="visually-hidden">
                                <?= TranslationOld::get('form_event_content') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="tinymce" rows="10" name="content">
                                <?= html_entities_decode(request()->post('content', $event?->getContent())) ?>
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions-submit">
        <a href="/admin/content/events" class="btn btn-outline-primary"
           data-toggle="tooltip" data-placement="top"
           title="<?= TranslationOld::get('back_button') ?>">
            <i class="fas fa-arrow-left"></i>
            <?= TranslationOld::get('back_button') ?>
        </a>

        <button type="submit" data-toggle="tooltip" data-placement="top"
                title="<?= TranslationOld::get('save_button') ?>"
                class="btn btn-outline-success">
            <?= TranslationOld::get('save_button') ?>
            <i class="far fa-save"></i>
        </button>

        <?php if (!$event?->isPublished()) : ?>
            <button type="submit" data-toggle="tooltip" data-placement="top"
                    name="save-and-publish" value="save_and_publish"
                    title="<?= TranslationOld::get('save_and_publish_button') ?>"
                    class="btn btn-outline-success">
                <?= TranslationOld::get('save_and_publish_button') ?>
                <i class="far fa-save"></i>
            </button>
        <?php endif; ?>
    </div>

    <div class="clearfix"></div>

</form>

<div class="modal fade thumbnailModal" id="modal" tabindex="-1" role="dialog"
     aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">
                    <?= TranslationOld::get('form_cut_image') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img class="image" id="thumbnailImage" src="" alt="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <?= TranslationOld::get('cancel_button') ?>
                </button>
                <button type="button" class="btn btn-primary" id="cropThumbnail">
                    <?= TranslationOld::get('cut_image_button') ?>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade bannerModal" id="modal" tabindex="-1"
     role="dialog"
     aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">
                    <?= TranslationOld::get('form_cut_image') ?>
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img class="image" id="bannerImage" src="" alt="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <?= TranslationOld::get('cancel_button') ?>
                </button>
                <button type="button" class="btn btn-primary" id="cropBanner">
                    <?= TranslationOld::get('cut_image_button') ?>
                </button>
            </div>
        </div>
    </div>
</div>
