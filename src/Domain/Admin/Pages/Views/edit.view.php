<?php

/**
 * @file
 */

declare(strict_types=1);

use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Pages\Models\Page;
use Domain\Admin\Pages\Repositories\PageRepository;
use Components\Security\CSRF;

$page = new PageRepository($page ?? NULL);
$user = new User();

$disabled = '';
if ($user->getRights() !== User::DEVELOPER
    && $page->getInMenu() === Page::PAGE_STATIC
) {
  $disabled = 'disabled';
}

$action = '/admin/content/pages/page/create/store';
$removeBannerAction = '';
$removeThumbnailAction = '';
$publishActionsVisible = FALSE;
if ($page->getId() !== 0) {
  $publishActionsVisible = TRUE;
  $action = '/admin/content/pages/page/edit/' . $page->getId() . '/store';
  $removeThumbnailAction = '/admin/content/pages/page/edit/' . $page->getId() . '/remove/thumbnail';
  $removeBannerAction = '/admin/content/pages/page/edit/' . $page->getId() . '/remove/banner';
}

if ($page->getInMenu() === Page::PAGE_STATIC) {
  $publishActionsVisible = FALSE;
}

$collapsePageDetails = 'show';
if (!empty($page->getTitle())
    && !empty($page->getInMenu())
    && !empty($page->getSlug())
) {
  $collapsePageDetails = '';
}

$collapsePagePictures = 'show';
if (!empty($page->getThumbnail())
    || !empty($page->getBanner())
) {
  $collapsePagePictures = '';
}

$pageInMenu = (int) request()->post('pageInMenu', (string) $page->getInMenu());
?>
<div class="form-actions-container">
    <?php if ($publishActionsVisible) : ?>
        <?php if ($disabled === '' && $page->isPublished()) : ?>
            <form method="post" class="form-actions"
                  action="/admin/content/pages/page/unpublish/<?php echo $page->getId() ?>">
                <?php echo CSRF::insertToken('/admin/content/pages/page/unpublish/' . $page->getId()) ?>

                <button type="submit" class="btn btn-outline-danger">
                    <?php echo TranslationOld::get('unpublish_button') ?>
                </button>
            </form>
        <?php elseif ($disabled === '') : ?>
            <form method="post" class="form-actions"
                  action="/admin/content/pages/page/publish/<?php echo $page->getId() ?>">
                <?php echo CSRF::insertToken('/admin/content/pages/page/publish/' . $page->getId()) ?>

                <button type="submit" class="btn btn-outline-success">
                    <?php echo TranslationOld::get('publish_button') ?>
                </button>
            </form>
        <?php endif; ?>
    <?php endif; ?>

    <?php if ($removeThumbnailAction !== '' && $page->getThumbnail() !== '') : ?>
        <form method="post" class="form-actions"
              action="<?php echo $removeThumbnailAction ?>">
            <?php echo CSRF::insertToken($removeThumbnailAction) ?>

            <button type="submit"
                    name="remove-thumbnail"
                    class="btn btn-outline-danger">
                <?php echo TranslationOld::get('delete_thumbnail_button') ?>
            </button>
        </form>
    <?php endif; ?>

    <?php if ($removeBannerAction !== '' && $page->getBanner() !== '') : ?>
        <form method="post" class="form-actions"
              action="<?php echo $removeBannerAction ?>">
            <?php echo CSRF::insertToken($removeBannerAction) ?>
            <button type="submit"
                    name="delete-banner"
                    class="btn btn-outline-danger">
                <?php echo TranslationOld::get('delete_banner_button') ?>
            </button>
        </form>
    <?php endif; ?>
</div>

<form method="post" action="<?php echo $action ?>">
    <?php echo CSRF::insertToken($action) ?>

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
                <div class="collapse <?php echo $collapsePageDetails ?>"
                     id="collapsePageDetails">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="slug">
                                <?php echo TranslationOld::get('form_page_slug') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="slug" id="slug"
                                   class="form-control"
                                   placeholder="<?php echo TranslationOld::get('form_page_slug') ?>"
                                   value="<?php echo request()->post(
                                    'slug',
                                    $page->getSlug()
) ?>" <?php echo $disabled ?> required>
                        </div>

                        <div class="form-group">
                            <label for="title">
                                <?php echo TranslationOld::get('form_title') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" id="title"
                                   class="form-control"
                                   placeholder="<?php echo TranslationOld::get('form_title') ?>"
                                   value="<?php echo request()->post(
                                       'title',
                                       $page->getTitle()
                                   ) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="pageInMenu">
                                <?php echo TranslationOld::get('form_show_page_in_menu') ?>
                                <span class="text-danger">*</span>
                            </label>

                            <select id="pageInMenu" class="form-control"
                                    name="pageInMenu" <?php echo $disabled ?>
                                    required>
                                <option value="<?php echo Page::PAGE_NORMAL ?>"
                                    <?php echo $pageInMenu === Page::PAGE_NORMAL ? 'selected' : '' ?>>
                                    <?php echo TranslationOld::get('page_normal') ?>
                                </option>
                                <option value="<?php echo Page::PAGE_STATIC ?>"
                                    <?php echo $pageInMenu === Page::PAGE_STATIC ? 'selected' : '' ?>>
                                    <?php echo TranslationOld::get('page_static') ?>
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
                <div class="collapse <?php echo $collapsePagePictures ?>"
                     id="collapsePagePictures">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="mb-2">
                                        <?php echo TranslationOld::get('form_thumbnail_size') ?>
                                    </div>
                                    <div class="custom-file">
                                        <input type="file"
                                               class="custom-file-input"
                                               id="inputThumbnail">
                                        <label class="custom-file-label"
                                               for="inputThumbnail">
                                            Kies foto
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <img class="img-thumbnail"
                                         src="<?php echo $page->getThumbnail() ?>"
                                         id="thumbnailOutput"
                                         alt="Thumbnail">
                                    <input type="hidden" name="thumbnail"
                                           id="thumbnailInputOutput">
                                </div>

                                <div class="thumbnailProgress progress">
                                    <div
                                        class="thumbnail-progress-bar progress-bar progress-bar-striped progress-bar-animated"
                                        role="progressbar"
                                        aria-valuenow="0" aria-valuemin="0"
                                        aria-valuemax="100">0%
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
                                        <?php echo TranslationOld::get('form_banner_size') ?>
                                    </div>

                                    <div class="custom-file">
                                        <input type="file"
                                               class="custom-file-input"
                                               id="inputBanner">
                                        <label class="custom-file-label"
                                               for="inputBanner">
                                            Kies foto
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <img class="img-thumbnail"
                                         src="<?php echo $page->getBanner() ?>"
                                         id="bannerOutput"
                                         alt="Banner">
                                    <input type="hidden" name="banner"
                                           id="bannerInputOutput">
                                </div>

                                <div class="form-group">
                                    <div class="bannerProgress progress">
                                        <div
                                            class="banner-progress-bar progress-bar progress-bar-striped progress-bar-animated"
                                            role="progressbar"
                                            aria-valuenow="0" aria-valuemin="0"
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
                                <?php echo TranslationOld::get('form_page_content') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <textarea class="form-control" id="tinymce"
                                      rows="10" name="content">
                                    <?php echo html_entities_decode(
                                       request()->post(
                                            'content',
                                            $page->getContent()
                                        )
                                   ) ?>
                                </textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="form-actions-submit">
        <a href="/admin/content/pages"
           class="btn btn-outline-primary"
           data-toggle="tooltip"
           data-placement="top"
           title="<?php echo TranslationOld::get('back_button') ?>">
            <i class="fas fa-arrow-left"></i>
            <?php echo TranslationOld::get('back_button') ?>
        </a>

        <button type="submit"
                data-toggle="tooltip"
                data-placement="top"
                title="<?php echo TranslationOld::get('save_button') ?>"
                class="btn btn-outline-success">
            <?php echo TranslationOld::get('save_button') ?>
            <i class="far fa-save"></i>
        </button>

        <?php if (!$page->isPublished()) : ?>
            <button type="submit"
                    data-toggle="tooltip"
                    data-placement="top"
                    name="save-and-publish"
                    title="<?php echo TranslationOld::get('save_and_publish_button') ?>"
                    class="btn btn-outline-success">
                <?php echo TranslationOld::get('save_and_publish_button') ?>
                <i class="far fa-save"></i>
            </button>
        <?php endif; ?>
    </div>

    <div class="clearfix"></div>
</form>

<div class="modal fade thumbnailModal" id="modal"
     tabindex="-1" role="dialog"
     aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">
                    <?php echo TranslationOld::get('form_cut_image') ?>
                </h5>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img class="image" id="thumbnailImage"
                         src="" alt="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                    <?php echo TranslationOld::get('cancel_button') ?>
                </button>
                <button type="button"
                        class="btn btn-primary"
                        id="cropThumbnail">
                    <?php echo TranslationOld::get('cut_image_button') ?>
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
                    <?php echo TranslationOld::get('form_cut_image') ?>
                </h5>
                <button type="button" class="close"
                        data-dismiss="modal"
                        aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="img-container">
                    <img class="image" id="bannerImage"
                         src="" alt="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button"
                        class="btn btn-secondary"
                        data-dismiss="modal">
                    <?php echo TranslationOld::get('cancel_button') ?>
                </button>
                <button type="button"
                        class="btn btn-primary"
                        id="cropBanner">
                    <?php echo TranslationOld::get('cut_image_button') ?>
                </button>
            </div>
        </div>
    </div>
</div>
