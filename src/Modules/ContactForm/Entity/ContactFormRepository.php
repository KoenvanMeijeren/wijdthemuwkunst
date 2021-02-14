<?php

namespace Modules\ContactForm\Entity;

use System\Entity\EntityRepositoryBase;

/**
 * Defines a repository for setting entities.
 *
 * @package Modules\Setting\Entity
 */
final class ContactFormRepository extends EntityRepositoryBase implements ContactFormRepositoryInterface {

  /**
   * {@inheritDoc}
   */
  public function loadBySetting(string $setting): ?ContactFormInterface {
    return $this->firstByAttributes([
      "{$this->entity->getTable()}_key" => $setting,
    ]);
  }

}
