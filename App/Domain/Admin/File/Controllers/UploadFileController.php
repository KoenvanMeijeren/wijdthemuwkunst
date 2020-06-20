<?php

declare(strict_types=1);


namespace Domain\Admin\File\Controllers;

use Domain\Admin\File\Actions\UploadFileAction;
use Domain\Admin\File\Actions\UploadImageAction;

/**
 * The controller for uploading files.
 *
 * @package Domain\Admin\File\Controllers
 */
final class UploadFileController {

  /**
   * Stores the uploaded file in the database and on the file system.
   */
  public function store(): void {
    $upload = new UploadFileAction();

    $upload->execute();
  }

  /**
   * Uploads a thumbnail images and store in the database and on the file system.
   */
  public function thumbnail(): void {
    $upload = new UploadImageAction('thumbnailOutput');
    $upload->execute();
  }

  /**
   * Uploads a banner images and store in the database and on the file system.
   */
  public function banner(): void {
    $upload = new UploadImageAction('bannerOutput');
    $upload->execute();
  }

}
