<?php

declare(strict_types=1);


namespace Domain\Admin\File\Actions;

use Components\Actions\FileAction;

/**
 * Provides an action class for uploading files.
 *
 * @package Domain\Admin\File\Actions
 */
final class UploadFileAction extends FileAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    parent::handle();

    $data = [
      'location' => $this->fileLocation,
    ];

    echo json_encode($data, JSON_THROW_ON_ERROR);

    return TRUE;
  }

}
