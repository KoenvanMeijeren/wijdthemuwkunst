<?php

namespace Modules\ContactForm\Entity;

use System\Entity\EntityRepositoryInterface;

/**
 * Provides an interface for text repositories.
 *
 * @package Domain\Admin\Text\Entity
 */
interface ContactFormRepositoryInterface extends EntityRepositoryInterface {

  /**
   * Loads a setting for a given name.
   *
   * @param string $setting
   *   The setting to search for.
   *
   * @return ContactFormInterface|null
   *   The setting entity or null.
   */
  public function loadBySetting(string $setting): ?ContactFormInterface;

}
