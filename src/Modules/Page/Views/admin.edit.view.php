<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\Route\RouteRights;
use Components\Security\CSRF;
use Components\Translation\TranslationOld;
use Modules\Page\Entity\PageInterface;
use Modules\Page\Entity\PageVisibility;

/** @var PageInterface $entity */
$entity = $page ?? null;
$current_user = user();

$disabled = '';
if ($current_user->getRouteRights()->hasAccessForbidden(RouteRights::DEVELOPER)
  && $entity?->getVisibility()->isEqual(PageVisibility::PAGE_STATIC)) {
  $disabled = 'disabled';
}

$action = '/admin/content/pages/page/create/store';
$removeBannerAction = '';
$removeThumbnailAction = '';
$publishActionsVisible = FALSE;
if ($entity && $entity?->id() !== 0) {
  $publishActionsVisible = TRUE;
  $action = '/admin/content/pages/page/edit/' . $entity?->id() . '/store';
  $removeThumbnailAction = '/admin/content/pages/page/edit/' . $entity?->id() . '/remove/thumbnail';
  $removeBannerAction = '/admin/content/pages/page/edit/' . $entity?->id() . '/remove/banner';
}

if ($entity?->getVisibility()->isEqual(PageVisibility::PAGE_STATIC)) {
  $publishActionsVisible = FALSE;
}

$collapsePageDetails = 'show';
if (!empty($entity?->getTitle()) && !empty($entity?->getVisibilityNumeric()) && !empty($entity?->getSlug())) {
  $collapsePageDetails = '';
}

$collapsePagePictures = 'show';
if (!empty($entity?->getThumbnail()) || !empty($entity?->getBanner())) {
  $collapsePagePictures = '';
}

$visibility = (int) request()->post('visibility', (string) $entity?->getVisibilityNumeric());
?>
<div class="form-actions-container">
    <?php if ($publishActionsVisible) : ?>
        <?php if ($disabled === '' && $entity?->isPublished()) : ?>
            <form method="post" class="form-actions"
                  action="/admin/content/pages/page/unpublish/<?= $entity?->id() ?>">
                <?= CSRF::insertToken('/admin/content/pages/page/unpublish/' . $entity?->id()) ?>

                <button type="submit" class="btn btn-outline-danger">
                    <?= TranslationOld::get('unpublish_button') ?>
                </button>
            </form>
        <?php elseif ($disabled === '') : ?>
            <form method="post" class="form-actions"
                  action="/admin/content/pages/page/publish/<?= $entity?->id() ?>">
                <?= CSRF::insertToken('/admin/content/pages/page/publish/' . $entity?->id()) ?>

                <button type="submit" class="btn btn-outline-success">
                    <?= TranslationOld::get('publish_button') ?>
                </button>
            </form>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($removeThumbnailAction !== '' && $entity?->getThumbnail() !== '') : ?>
        <form method="post" class="form-actions" action="<?= $removeThumbnailAction ?>">
            <?= CSRF::insertToken($removeThumbnailAction) ?>

            <button type="submit" name="remove-thumbnail" class="btn btn-outline-danger">
                <?= TranslationOld::get('delete_thumbnail_button') ?>
            </button>
        </form>
    <?php endif; ?>

    <?php if ($removeBannerAction !== '' && $entity?->getBanner() !== '') : ?>
        <form method="post" class="form-actions"
              action="<?= $removeBannerAction ?>">
            <?= CSRF::insertToken($removeBannerAction) ?>
            <button type="submit" name="delete-banner" class="btn btn-outline-danger">
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
                <a href="#collapsePageDetails" class="d-block card-header py-3"
                   data-toggle="collapse" role="button" aria-expanded="true"
                   aria-controls="collapsePageDetails">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Pagina gegevens
                    </h6>
                </a>
                <div class="collapse <?= $collapsePageDetails ?>"
                     id="collapsePageDetails">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="slug">
                                <?= TranslationOld::get('form_page_slug') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="slug" id="slug"
                                   class="form-control"
                                   placeholder="<?= TranslationOld::get('form_page_slug') ?>"
                                   value="<?= request()->post('slug', (string) $entity?->getSlug()) ?>"
                                  <?= $disabled ?> required>
                        </div>

                        <div class="form-group">
                            <label for="title">
                                <?= TranslationOld::get('form_title') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" id="title" class="form-control"
                                   placeholder="<?= TranslationOld::get('form_title') ?>"
                                   value="<?= request()->post('title', (string) $entity?->getTitle()) ?>"
                                   required>
                        </div>

                        <div class="form-group">
                            <label for="visibility">
                                <?= TranslationOld::get('form_show_page_in_menu') ?>
                                <span class="text-danger">*</span>
                            </label>

                            <select id="visibility" class="form-control" name="visibility" <?= $disabled ?>required>
                                <option value="<?= PageVisibility::PAGE_NORMAL->value ?>"
                                    <?= $visibility === PageVisibility::PAGE_NORMAL->value ? 'selected' : '' ?>>
                                    <?= TranslationOld::get('page_normal') ?>
                                </option>
                                <option value="<?= PageVisibility::PAGE_STATIC->value ?>"
                                    <?= $visibility === PageVisibility::PAGE_STATIC->value ? 'selected' : '' ?>>
                                    <?= TranslationOld::get('page_static') ?>
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow mb-4">
                <a href="#collapsePagePictures" class="d-block card-header py-3"
                   data-toggle="collapse" role="button" aria-expanded="true"
                   aria-controls="collapsePagePictures">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Pagina foto's
                    </h6>
                </a>
                <div class="collapse <?= $collapsePagePictures ?>"
                     id="collapsePagePictures">
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
                                    <img class="img-thumbnail" src="<?= $entity?->getThumbnail() ?>"
                                         id="thumbnailOutput" alt="Thumbnail">
                                    <input type="hidden" name="thumbnail" id="thumbnailInputOutput">
                                </div>

                                <div class="thumbnailProgress progress">
                                    <div
                                        class="thumbnail-progress-bar progress-bar progress-bar-striped progress-bar-animated"
                                        role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                      0%
                                    </div>
                                </div>

                                <div class="thumbnailAlert alert"
                                     role="alert"></div>
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
                                    <img class="img-thumbnail" src="<?= $entity?->getBanner() ?>"
                                         id="bannerOutput" alt="Banner">
                                    <input type="hidden" name="banner" id="bannerInputOutput">
                                </div>

                                <div class="form-group">
                                    <div class="bannerProgress progress">
                                        <div
                                            class="banner-progress-bar progress-bar progress-bar-striped progress-bar-animated"
                                            role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                          0%
                                        </div>
                                    </div>

                                    <div class="bannerAlert alert" role="alert"></div>
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
                <a href="#collapsePageContent" class="d-block card-header py-3"
                   data-toggle="collapse" role="button" aria-expanded="true"
                   aria-controls="collapsePageContent">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Pagina content
                    </h6>
                </a>
                <div class="collapse show" id="collapsePageContent">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="tinymce" class="visually-hidden">
                                <?= TranslationOld::get('form_page_content') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="tinymce" rows="10" name="content">
                                <?= html_entities_decode(request()->post('content', (string) $entity?->getContent())) ?>
                            </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions-submit">
        <a href="/admin/content/pages" class="btn btn-outline-primary"
           data-toggle="tooltip" data-placement="top"
           title="<?= TranslationOld::get('back_button') ?>">
            <i class="fas fa-arrow-left"></i>
            <?= TranslationOld::get('back_button') ?>
        </a>

        <button type="submit" data-toggle="tooltip" data-placement="top"
                title="<?= TranslationOld::get('save_button') ?>" class="btn btn-outline-success">
            <?= TranslationOld::get('save_button') ?>
            <i class="far fa-save"></i>
        </button>

        <?php if (!$entity?->isPublished()) : ?>
            <button type="submit" data-toggle="tooltip" data-placement="top" name="save-and-publish"
                    title="<?= TranslationOld::get('save_and_publish_button') ?>" class="btn btn-outline-success">
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
