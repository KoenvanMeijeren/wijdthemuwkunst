<?php
declare(strict_types=1);

namespace Modules\Slug\Entity;

use System\Entity\EntityInterface;
use System\Entity\Status\EntityStatusInterface;

/**
 * Provides an interface for Slug entities.
 *
 * @package Modules\Slug\Entity
 */
interface SlugInterface extends EntityInterface, EntityStatusInterface {

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

}
