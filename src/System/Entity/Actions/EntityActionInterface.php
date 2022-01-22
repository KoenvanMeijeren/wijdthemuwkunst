<?php

namespace System\Entity\Actions;

use Components\Actions\ActionInterface;

/**
 * Provides an interface for entity actions.
 *
 * @package System\Entity\Actions
 */
interface EntityActionInterface extends ActionInterface {

  /**
   * Gets the entity id.
   *
   * @return int|null
   *   The entity id.
   */
  public function getEntityId(): ?int;

  /**
   * Gets the entity type.
   *
   * @return string
   *   The entity type.
   */
  public function getEntityType(): string;

}
