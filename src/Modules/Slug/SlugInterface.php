<?php
declare(strict_types=1);

namespace Modules\Slug;

use System\Entity\EntityInterface;

/**
 * Provides an interface for references to the slug entity.
 *
 * @package Modules\Slug
 */
interface  SlugInterface extends EntityInterface {

  /**
   * Sets the slug.
   *
   * @param string $url
   *   The url to generate a slug for.
   *
   * @return $this
   *   The called object reference.
   */
  public function setSlug(string $url);

  /**
   * Gets the slug.
   *
   * @return string|null
   *   The slug.
   */
  public function getSlug(): ?string;

}
