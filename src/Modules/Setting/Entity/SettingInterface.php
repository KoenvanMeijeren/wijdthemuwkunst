<?php
declare(strict_types=1);

namespace Modules\Setting\Entity;

use System\Entity\EntityInterface;
use System\Entity\Status\EntityStatusInterface;

/**
 * Provides an interface for setting entities.
 *
 * @package Modules\Setting\Entity
 */
interface SettingInterface extends EntityInterface, EntityStatusInterface {

  /**
   * Sets the key of the text.
   *
   * @param string $key
   *   The name of the key.
   *
   * @return $this
   */
  public function setKey(string $key): SettingInterface;

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
  public function setValue(string $value): SettingInterface;

  /**
   * Gets the value of the text.
   *
   * @return string|null
   *   The value of the text.
   */
  public function getValue(): ?string;

}
