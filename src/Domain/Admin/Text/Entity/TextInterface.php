<?php

namespace Domain\Admin\Text\Entity;

use System\Entity\EntityInterface;

/**
 * Provides an interface for text entities.
 *
 * @package Domain\Admin\Text\Entity
 */
interface TextInterface extends EntityInterface {

  /**
   * Sets the key of the text.
   *
   * @param string $key
   *   The name of the key.
   *
   * @return $this
   */
  public function setKey(string $key);

  /**
   * Gets the key of the text.
   *
   * @return string|null
   *   The key of the text.
   */
  public function getKey(): ?string;

  /**
   * Sets the value of the text.
   *
   * @param string $value
   *   The value of the text.
   *
   * @return $this
   */
  public function setValue(string $value);

  /**
   * Gets the value of the text.
   *
   * @return string|null
   *   The value of the text.
   */
  public function getValue(): ?string;

  /**
   * Sets the language of the text.
   *
   * @param string $language
   *   The language of the text.
   *
   * @return $this
   */
  public function setLanguage(string $language);

  /**
   * Gets the language of the text.
   *
   * @return string|null
   *   The value of the text.
   */
  public function getLanguage(): ?string;

  /**
   * Determines if the text is deleted.
   *
   * @param bool $deleted
   *   If the text text is deleted.
   *
   * @return $this
   */
  public function setDeleted(bool $deleted = TRUE);

  /**
   * If the text is deleted.
   *
   * @return bool
   *   Whether the text is deleted or not.
   */
  public function isDeleted(): bool;

}
