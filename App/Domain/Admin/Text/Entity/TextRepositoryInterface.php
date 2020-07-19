<?php

namespace Domain\Admin\Text\Entity;

use System\Entity\EntityRepositoryInterface;

/**
 * Provides an interface for text repositories.
 *
 * @package Domain\Admin\Text\Entity
 */
interface TextRepositoryInterface extends EntityRepositoryInterface {

  /**
   * Loads a translation for a given text.
   *
   * @param string $text
   *   The text to search for.
   *
   * @return TextInterface|null
   *   The text entity or null.
   */
  public function loadByText(string $text): ?TextInterface;

}
