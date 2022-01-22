<?php

declare(strict_types=1);


namespace Modules\File\Actions;

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
  public function getOutput(): string {
    $data = [
      'location' => $this->fileLocation,
    ];

    return json_encode($data, JSON_THROW_ON_ERROR);
  }

}
