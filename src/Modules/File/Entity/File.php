<?php
declare(strict_types=1);

namespace Modules\File\Entity;

use System\Entity\EntityBase;

/**
 * Defines the file entity.
 *
 * @package Modules\File\Entity
 */
class File extends EntityBase implements FileInterface {

  /**
   * {@inheritdoc}
   */
  protected string $table = 'file';

  /**
   * {@inheritdoc}
   */
  public function setPath(string $path): FileInterface {
    $this->set('path', $path);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getPath(): ?string {
    return $this->get('path');
  }

  /**
   * {@inheritDoc}
   */
  public function setDeleted(bool $deleted = TRUE): FileInterface {
    $this->set('is_deleted', $deleted);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isDeleted(): bool {
    return (bool) $this->get('is_deleted');
  }

}
