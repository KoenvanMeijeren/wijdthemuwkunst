<?php
declare(strict_types=1);

namespace Modules\File\Controllers;

use Modules\File\Actions\UploadFileAction;
use Modules\File\Actions\UploadImageAction;
use System\Controller\ControllerBase;

/**
 * The controller for uploading files.
 *
 * @package Domain\Admin\File\Controllers
 */
final class UploadFileController extends ControllerBase {

  /**
   * Stores the uploaded file in the database and on the filesystem.
   */
  public function store(): void {
    $upload = new UploadFileAction();
    $upload->execute();
  }

  /**
   * Uploads a thumbnail images and store in the database and on the filesystem.
   */
  public function thumbnail(): string {
    $upload = new UploadImageAction('thumbnailOutput');
    $upload->execute();

    return $upload->getOutput();
  }

  /**
   * Uploads a banner images and store in the database and on the file system.
   */
  public function banner(): string {
    $upload = new UploadImageAction('bannerOutput');
    $upload->execute();

    return $upload->getOutput();
  }

}
