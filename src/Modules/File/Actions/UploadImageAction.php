<?php
declare(strict_types=1);

namespace Modules\File\Actions;

use Cake\Chronos\Chronos;
use Components\Actions\FileAction;
use Components\File\Upload;

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
   * The output of the file upload.
   *
   * @var string[]
   */
  protected array $data;

  /**
   * UploadImageAction constructor.
   *
   * @param string $name
   *   The name of the image file.
   */
  public function __construct(string $name) {
    parent::__construct();

    $this->file = $this->request()->file->get($name);
  }

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    if (isset($this->file['name'])) {
      $datetime = new Chronos();
      $this->file['name'] .= $datetime->toDateTimeString();
    }

    $uploader = new Upload($this->file);

    if (count($this->file) > 0 && $uploader->prepare()) {
      $uploader->execute();
    }

    $this->data = [
      'location' => $uploader->getFileIfItExists(),
    ];

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  public function getOutput(): string {
    return json_encode($this->data, JSON_THROW_ON_ERROR);
  }

}
