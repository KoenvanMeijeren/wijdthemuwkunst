<?php

namespace Domain\Admin\Text\Entity;

use System\Entity\EntityRepositoryBase;

/**
 * Defines a repository for text entities.
 *
 * @package Domain\Admin\Text\Entity
 */
final class TextRepository extends EntityRepositoryBase implements TextRepositoryInterface {

  /**
   * {@inheritDoc}
   */
  public function loadByText(string $text): ?TextInterface {
    return $this->firstByAttributes([
      "{$this->entity->getTable()}_key" => $text
    ]);
  }

}
