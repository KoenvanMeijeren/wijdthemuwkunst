<?php
declare(strict_types=1);

namespace Modules\Contact\Entity;

use Components\Datetime\DateTimeInterface;
use System\Entity\EntityInterface;
use System\Entity\Status\EntityStatusInterface;

/**
 * Provides an interface for setting entities.
 *
 * @package Modules\Setting\Entity
 */
interface ContactInterface extends EntityInterface, EntityStatusInterface {

  /**
   * Sets the key of the text.
   *
   * @param string $name
   *   The name of the key.
   *
   * @return $this
   */
  public function setName(string $name): ContactInterface;

  /**
   * Gets the key of the text.
   *
   * @return string|null
   *   The key of the text.
   */
  public function getName(): ?string;

  /**
   * Sets the value of the text.
   *
   * @param string $email
   *   The value of the text.
   *
   * @return $this
   */
  public function setEmail(string $email): ContactInterface;

  /**
   * Gets the value of the text.
   *
   * @return string|null
   *   The value of the text.
   */
  public function getEmail(): ?string;

  /**
   * Sets the message of the text.
   *
   * @param string $message
   *   The message of the text.
   *
   * @return $this
   */
  public function setMessage(string $message): ContactInterface;

  /**
   * Gets the message of the text.
   *
   * @return string|null
   *   The message of the text.
   */
  public function getMessage(): ?string;

  /**
   * Sets the value of the text.
   *
   * @param DateTimeInterface $dateTime
   *   The datetime of the text.
   *
   * @return $this
   */
  public function setCreatedAt(DateTimeInterface $dateTime): ContactInterface;

  /**
   * Gets the created at of the text.
   *
   * @return string|null
   *   The created at of the text.
   */
  public function getCreatedAt(): ?string;

  /**
   * Gets the date of the text.
   *
   * @return DateTimeInterface
   *   The datetime of the text.
   */
  public function getDateTime(): DateTimeInterface;

}
