<?php

declare(strict_types=1);


namespace App\Domain\Admin\File\Models;

use Src\Model\Model;

/**
 * Provides a model for the file table to interact with the database.
 *
 * @package App\Domain\Admin\File\Models
 */
final class File extends Model {
  protected string $table = 'file';
  protected string $primaryKey = 'file_ID';
  protected string $pathKey = 'file_path';
  protected string $isDeleted = 'file_is_deleted';

  /**
   * Gets the primary key.
   *
   * @return string
   *   The primary key.
   */
  public function getPrimaryKey(): string {
    return $this->primaryKey;
  }

  /**
   * Gets the path key.
   *
   * @return string
   *   The path key.
   */
  public function getPathKey(): string {
    return $this->pathKey;
  }

}
