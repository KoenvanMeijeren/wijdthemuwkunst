<?php

namespace Modules\ContactForm\Entity;

use System\Entity\EntityInterface;

/**
 * Provides an interface for setting entities.
 *
 * @package Modules\Setting\Entity
 */
interface ContactFormInterface extends EntityInterface {

  /**
   * Sets the key of the text.
   *
   * @param string $key
   *   The name of the key.
   *
   * @return $this
   */
  public function setKey(string $key): ContactFormInterface;

  /**
   * Gets the key of the text.
   *
   * @return string|null
   *   The key of the text.
   */
  public function getKey(): ?string;

  /**
   * Gets the readable key of the text.
   *
   * @return string|null
   *   The key of the text.
   */
  public function getReadableKey(): ?string;

  /**
   * Sets the value of the text.
   *
   * @param string $value
   *   The value of the text.
   *
   * @return $this
   */
  public function setValue(string $value): ContactFormInterface;

  /**
   * Gets the value of the text.
   *
   * @return string|null
   *   The value of the text.
   */
  public function getValue(): ?string;

  /**
   * Determines if the text is deleted.
   *
   * @param bool $deleted
   *   If the text text is deleted.
   *
   * @return $this
   */
  public function setDeleted(bool $deleted = TRUE): ContactFormInterface;

  /**
   * If the text is deleted.
   *
   * @return bool
   *   Whether the text is deleted or not.
   */
  public function isDeleted(): bool;

}
