<?php

declare(strict_types=1);


namespace App\Domain\Admin\File\Actions;

use App\Domain\Admin\File\Models\File;
use Src\Action\Action;

/**
 *
 */
final class SaveFileAction extends Action {
  private File $file;

  private string $path;
  private int $id = 0;

  /**
   *
   */
  public function __construct(string $path) {
    $this->file = new File();
    $this->path = $path;
  }

  /**
   *
   */
  public function getId(): int {
    return $this->id;
  }

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $createdFile = $this->file->firstOrCreate([
      $this->file->getPathKey() => $this->path,
    ]);

    if ($createdFile === NULL) {
      return FALSE;
    }

    $this->id = (int) $createdFile->{$this->file->getPrimaryKey()};

    return TRUE;
  }

  /**
   * @inheritDoc
   */
  protected function authorize(): bool {
    return TRUE;
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    return TRUE;
  }

}
