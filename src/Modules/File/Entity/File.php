<?php
declare(strict_types=1);

namespace Modules\File\Entity;

use System\Entity\Status\EntityStatusBase;
use System\Entity\Type\ContentEntityType;

/**
 * Defines the file entity.
 *
 * @package Modules\File\Entity
 */
#[ContentEntityType(
  table: 'file'
)]
class File extends EntityStatusBase implements FileInterface {

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

}
