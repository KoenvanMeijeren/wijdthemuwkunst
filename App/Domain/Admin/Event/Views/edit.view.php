<?php
declare(strict_types=1);

use App\Domain\Admin\Event\Repositories\EventRepository;
use Src\Core\Request;
use Src\Security\CSRF;
use Src\Translation\Translation;

$event = new EventRepository($event ?? null);
$request = new Request();

$action = '/admin/concert/create/store';
$removeBannerAction = '';
$removeThumbnailAction = '';
if ($event->getId() !== 0) {
    $action = '/admin/concert/edit/' . $event->getId() . '/store';
    $removeThumbnailAction = '/admin/concert/edit/' . $event->getId() . '/remove/thumbnail';
    $removeBannerAction = '/admin/concert/edit/' . $event->getId() . '/remove/banner';
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-left">
                    <?= $title ?? '' ?>
                </h4>

                <div class="float-right">
                    <?php if ($event->isPublished()) : ?>
                        <form method="post"
                              action="/admin/concert/unpublish/<?= $event->getId() ?>">
                            <?= CSRF::insertToken('/admin/concert/unpublish/' . $event->getId()) ?>

                            <button type="submit" class="btn btn-danger">
                                <?= Translation::get('unpublish_button') ?>
                            </button>
                        </form>
                    <?php else : ?>
                        <form method="post"
                              action="/admin/concert/publish/<?= $event->getId() ?>">
                            <?= CSRF::insertToken('/admin/concert/publish/' . $event->getId()) ?>

                            <button type="submit" class="btn btn-success">
                                <?= Translation::get('publish_button') ?>
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-2">
                        <?php if ($removeThumbnailAction !== '' && $event->getThumbnail() !== '') : ?>
                            <form method="post"
                                  action="<?= $removeThumbnailAction ?>">
                                <?= CSRF::insertToken($removeThumbnailAction) ?>

                                <button type="submit" name="remove-thumbnail"
                                        class="btn btn-danger mt-3">
                                    Delete thumbnail
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>

                    <div class="col-sm-2">
                        <?php if ($removeBannerAction !== '' && $event->getBanner() !== '') : ?>
                            <form method="post"
                                  action="<?= $removeBannerAction ?>">
                                <?= CSRF::insertToken($removeBannerAction) ?>
                                <button type="submit"
                                        name="delete-banner"
                                        class="btn btn-danger mt-3">
                                    Delete banner
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>

                <form method="post" action="<?= $action ?>">
                    <?= CSRF::insertToken($action) ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="title">
                                <?= Translation::get('form_title') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" id="title"
                                   class="form-control"
                                   placeholder="<?= Translation::get('form_title') ?>"
                                   value="<?= $request->post(
    'title',
    $event->getTitle()
) ?>"
                                   required>
                        </div>
                        <div class="col-sm-6">
                            <label for="location">
                                <?= Translation::get('form_location') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="location" id="location"
                                   class="form-control"
                                   placeholder="<?= Translation::get('form_location') ?>"
                                   value="<?= $request->post(
    'location',
    $event->getLocation()
) ?>"
                                   required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="date">
                                <?= Translation::get('form_date') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date" name="date" id="date"
                                   class="form-control"
                                   placeholder="<?= Translation::get('form_date') ?>"
                                   value="<?= $request->post(
                                       'date',
                                       $event->getDate()
                                   ) ?>"
                                   required>
                        </div>
                        <div class="col-sm-6">
                            <label for="time">
                                <?= Translation::get('form_time') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="time" name="time" id="time"
                                   class="form-control"
                                   placeholder="<?= Translation::get('form_time') ?>"
                                   value="<?= $request->post(
                                       'time',
                                       $event->getTime()
                                   ) ?>"
                                   required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputThumbnail">
                                    Thumbnail -
                                    Aanbevolen grootte 350x300
                                </label>
                                <input
                                    class="form-control form-control-file col-sm-10"
                                    id="inputThumbnail" type="file">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="inputBanner">
                                    Banner - Aanbevolen
                                    grootte 350x300
                                </label>
                                <input
                                    class="form-control form-control-file col-sm-10"
                                    id="inputBanner" type="file">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <img class="img-thumbnail"
                                     src="<?= $event->getThumbnail() ?>"
                                     id="thumbnailOutput"
                                     alt="Thumbnail">
                                <input type="hidden" name="thumbnail"
                                       id="thumbnailInputOutput">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <img class="img-thumbnail"
                                     src="<?= $event->getBanner() ?>"
                                     id="bannerOutput"
                                     alt="Banner">
                                <input type="hidden" name="banner"
                                       id="bannerInputOutput">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
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
                        <div class="col-sm-6">
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

                    <div class="modal fade thumbnailModal" id="modal"
                         tabindex="-1" role="dialog"
                         aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel">
                                        Foto bijsnijden
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
                                        Annuleren
                                    </button>
                                    <button type="button"
                                            class="btn btn-primary"
                                            id="cropThumbnail">
                                        Bijsnijden
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
                                        Foto bijsnijden
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
                                        Annuleren
                                    </button>
                                    <button type="button"
                                            class="btn btn-primary"
                                            id="cropBanner">
                                        Bijsnijden
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="content">
                                    <?= Translation::get('form_event_content') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="content"
                                          rows="10" name="content">
                                    <?= parseHtmlEntities(
                                       $request->post(
                                           'content',
                                           $event->getContent()
                                       )
                                   ) ?>
                                </textarea>
                            </div>
                        </div>
                    </div>

                    <a href="/admin/concerten"
                       class="btn btn-default-small float-left"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="<?= Translation::get('back_button') ?>">
                        <i class="fas fa-arrow-left"></i>
                        <?= Translation::get('back_button') ?>
                    </a>

                    <button type="submit"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="<?= Translation::get('save_button') ?>"
                            class="btn btn-default-small float-right">
                        <?= Translation::get('save_button') ?>
                        <i class="far fa-save"></i>
                    </button>

                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
