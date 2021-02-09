<?php

namespace Modules\Setting\Entity;

use System\Entity\EntityRepositoryInterface;

/**
 * Provides an interface for text repositories.
 *
 * @package Domain\Admin\Text\Entity
 */
interface SettingRepositoryInterface extends EntityRepositoryInterface {

  /**
   * Loads a setting for a given name.
   *
   * @param string $setting
   *   The setting to search for.
   *
   * @return SettingInterface|null
   *   The setting entity or null.
   */
  public function loadBySetting(string $setting): ?SettingInterface;

}
