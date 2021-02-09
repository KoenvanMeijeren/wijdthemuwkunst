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
   * Loads a translation for a given text.
   *
   * @param string $text
   *   The text to search for.
   *
   * @return SettingInterface|null
   *   The text entity or null.
   */
  public function loadBySetting(string $text): ?SettingInterface;

}
