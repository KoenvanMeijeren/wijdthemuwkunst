<?php
declare(strict_types=1);

namespace Modules\Slug\Entity;

use System\Entity\EntityInterface;

/**
 * Provides an interface for Slug entities.
 *
 * @package Modules\Slug\Entity
 */
interface SlugInterface extends EntityInterface {

  /**
   * Sets the key of the text.
   *
   * @param string $name
   *   The name of the key.
   *
   * @return $this
   */
  public function setName(string $name): SlugInterface;

  /**
   * Gets the key of the text.
   *
   * @return string|null
   *   The key of the text.
   */
  public function getName(): ?string;

  /**
   * Determines if the text is deleted.
   *
   * @param bool $deleted
   *   If the text text is deleted.
   *
   * @return $this
   */
  public function setDeleted(bool $deleted = TRUE): SlugInterface;

  /**
   * If the text is deleted.
   *
   * @return bool
   *   Whether the text is deleted or not.
   */
  public function isDeleted(): bool;

}
