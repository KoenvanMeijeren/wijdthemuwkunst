<?php

namespace Modules\Setting\Entity;

use System\Entity\EntityRepositoryBase;

/**
 * Defines a repository for setting entities.
 *
 * @package Modules\Setting\Entity
 */
final class SettingRepository extends EntityRepositoryBase implements SettingRepositoryInterface {

  /**
   * {@inheritDoc}
   */
  public function loadBySetting(string $text): ?SettingInterface {
    return $this->firstByAttributes([
      "{$this->entity->getTable()}_key" => $text,
    ]);
  }

}
