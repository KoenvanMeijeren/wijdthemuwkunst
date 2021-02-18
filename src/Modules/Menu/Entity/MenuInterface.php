<?php

namespace Modules\Menu\Entity;

use Modules\Slug\SlugInterface;
use System\Entity\EntityInterface;

/**
 * Provides an interface for Menu entities.
 *
 * @package Modules\Menu\Entity
 */
interface MenuInterface extends EntityInterface, SlugInterface {

  /**
   * Sets the key of the text.
   *
   * @param string $title
   *   The name of the key.
   *
   * @return $this
   */
  public function setTitle(string $title): MenuInterface;

  /**
   * Gets the key of the text.
   *
   * @return string|null
   *   The key of the text.
   */
  public function getTitle(): ?string;

  /**
   * Sets the value of the text.
   *
   * @param string $weight
   *   The value of the text.
   *
   * @return $this
   */
  public function setWeight(int $weight): MenuInterface;

  /**
   * Gets the value of the text.
   *
   * @return string|null
   *   The value of the text.
   */
  public function getWeight(): ?string;

  /**
   * Determines if the text is deleted.
   *
   * @param bool $deleted
   *   If the text text is deleted.
   *
   * @return $this
   */
  public function setDeleted(bool $deleted = TRUE): MenuInterface;

  /**
   * If the text is deleted.
   *
   * @return bool
   *   Whether the text is deleted or not.
   */
  public function isDeleted(): bool;

}
