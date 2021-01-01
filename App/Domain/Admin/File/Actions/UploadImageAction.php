<?php

declare(strict_types=1);


namespace Domain\Admin\File\Actions;

use Cake\Chronos\Chronos;
use Src\Action\FileAction;
use Src\Core\Upload;

/**
 * Provides an action class for uploading images.
 *
 * @package Domain\Admin\File\Actions
 */
final class UploadImageAction extends FileAction {

  /**
   * The uploaded file.
   *
   * @var array
   */
  private array $file;

  /**
   * UploadImageAction constructor.
   *
   * @param string $name
   *   The name of the image file.
   */
  public function __construct(string $name) {
    parent::__construct();

    $this->file = $this->request->file($name);
  }

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    if (array_key_exists('name', $this->file)) {
      $datetime = new Chronos();
      $this->file['name'] .= $datetime->toDateTimeString();
    }

    $uploader = new Upload($this->file);

    if (count($this->file) > 0 && $uploader->prepare() && $uploader->getFileIfItExists() === '') {
      $uploader->execute();
    }

    $data = [
      'location' => $uploader->getFileIfItExists(),
    ];

    echo json_encode($data, JSON_THROW_ON_ERROR);

    return TRUE;
  }

}
