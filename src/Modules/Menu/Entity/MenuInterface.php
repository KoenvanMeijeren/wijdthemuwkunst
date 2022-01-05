<?php
declare(strict_types=1);

namespace Modules\Menu\Entity;

use Modules\Slug\SlugInterface;
use System\Entity\EntityInterface;
use System\Entity\Status\EntityStatusInterface;

/**
 * Provides an interface for Menu entities.
 *
 * @package Modules\Menu\Entity
 */
interface MenuInterface extends EntityInterface, SlugInterface, EntityStatusInterface {

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

}
