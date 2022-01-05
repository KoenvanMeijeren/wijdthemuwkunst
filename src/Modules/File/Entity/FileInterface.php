<?php
declare(strict_types=1);

namespace Modules\File\Entity;

use System\Entity\EntityInterface;
use System\Entity\Status\EntityStatusInterface;

/**
 * Defines an interface for file entities.
 *
 * @package Modules\File\Entity
 */
interface FileInterface extends EntityInterface, EntityStatusInterface {

  /**
   * Sets the path of the file.
   *
   * @param string $path
   *   The path of the file.
   *
   * @return $this
   *   The called object reference.
   */
  public function setPath(string $path): FileInterface;

  /**
   * Gets the path of the file.
   *
   * @return string|null
   *   The path of the file.
   */
  public function getPath(): ?string;

}
