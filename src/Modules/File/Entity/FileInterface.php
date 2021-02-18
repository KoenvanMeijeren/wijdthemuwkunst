<?php
declare(strict_types=1);

namespace Modules\File\Entity;

use System\Entity\EntityInterface;

/**
 * Defines an interface for file entities.
 *
 * @package Modules\File\Entity
 */
interface FileInterface extends EntityInterface {

  /**
   * Sets the path of the text.
   *
   * @param string $path
   *   The path of the text.
   *
   * @return $this
   */
  public function setPath(string $path): FileInterface;

  /**
   * Gets the path of the text.
   *
   * @return string|null
   *   The path of the text.
   */
  public function getPath(): ?string;

  /**
   * Determines if the text is deleted.
   *
   * @param bool $deleted
   *   If the text text is deleted.
   *
   * @return $this
   */
  public function setDeleted(bool $deleted = TRUE): FileInterface;

  /**
   * If the text is deleted.
   *
   * @return bool
   *   Whether the text is deleted or not.
   */
  public function isDeleted(): bool;

}
