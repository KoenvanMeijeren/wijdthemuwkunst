<?php
declare(strict_types=1);

namespace Modules\Text\Entity;

use System\Entity\EntityInterface;
use System\Entity\Status\EntityStatusInterface;

/**
 * Provides an interface for text entities.
 *
 * @package Domain\Admin\Text\Entity
 */
interface TextInterface extends EntityInterface, EntityStatusInterface {

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

}
