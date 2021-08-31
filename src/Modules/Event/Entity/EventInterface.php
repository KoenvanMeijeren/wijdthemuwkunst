<?php
declare(strict_types=1);

namespace Modules\Event\Entity;

use Cake\Chronos\Date;
use Components\Datetime\DateTime;
use Modules\Slug\SlugInterface;
use System\Entity\EntityInterface;

/**
 * Provides an interface for Event entities.
 *
 * @package Modules\Event\Entity
 */
interface EventInterface extends EntityInterface, SlugInterface {

  /**
   * Sets the title of the entity.
   *
   * @param string $title
   *   The title of the entity.
   *
   * @return $this
   */
  public function setTitle(string $title): EventInterface;

  /**
   * Gets the title of the entity.
   *
   * @return string|null
   *   The title of the entity.
   */
  public function getTitle(): ?string;

  /**
   * Sets the thumbnail of the entity.
   *
   * @param int|null $thumbnail
   *   The thumbnail.
   *
   * @return $this
   */
  public function setThumbnail(?int $thumbnail): EventInterface;

  /**
   * Gets the thumbnail of the entity.
   *
   * @return string|null
   *   The thumbnail of the entity.
   */
  public function getThumbnail(): ?string;

  /**
   * Sets the banner of the entity.
   *
   * @param int|null $banner
   *   The banner.
   *
   * @return $this
   */
  public function setBanner(?int $banner): EventInterface;

  /**
   * Gets the banner of the entity.
   *
   * @return string|null
   *   The banner of the entity.
   */
  public function getBanner(): ?string;

  /**
   * Sets the content of the entity.
   *
   * @param string $content
   *   The content.
   *
   * @return $this
   */
  public function setContent(string $content): EventInterface;

  /**
   * Gets the content of the entity.
   *
   * @return string|null
   *   The content of the entity.
   */
  public function getContent(): ?string;

  /**
   * Sets the location of the entity.
   *
   * @param string $location
   *   The location.
   *
   * @return $this
   */
  public function setLocation(string $location): EventInterface;

  /**
   * Gets the location of the entity.
   *
   * @return string|null
   *   The location of the entity.
   */
  public function getLocation(): ?string;

  /**
   * Sets the date of the entity.
   *
   * @param \Components\Datetime\DateTime $dateTime
   *   The date time.
   *
   * @return $this
   */
  public function setDate(DateTime $dateTime): EventInterface;

  /**
   * Gets the date time of the entity.
   *
   * @return string|null
   *   The date time of the entity.
   */
  public function getDateTime(): ?string;

  /**
   * Gets the date of the entity.
   *
   * @return string
   *   The date of the entity.
   */
  public function getDate(): string;

  /**
   * Gets the time of the entity.
   *
   * @return string
   *   The time of the entity.
   */
  public function getTime(): string;

  /**
   * Gets the time of the entity.
   *
   * @return string
   *   The time of the entity.
   */
  public function getReadableDatetime(): string;

  /**
   * Gets the time of the entity.
   *
   * @return string
   *   The time of the entity.
   */
  public function getDayNumber(): string;

  /**
   * Gets the time of the entity.
   *
   * @return string
   *   The time of the entity.
   */
  public function getShortDate(): string;

  /**
   * Determines if the text is deleted.
   *
   * @param bool $published
   *   If the entity is published.
   *
   * @return $this
   */
  public function setPublished(bool $published = TRUE): EventInterface;

  /**
   * If the entity is published.
   *
   * @return bool
   *   Whether the entity is published or not.
   */
  public function isPublished(): bool;

  /**
   * Determines if the entity is archived.
   *
   * @param bool $archived
   *   If the entity is archived.
   *
   * @return $this
   */
  public function setArchived(bool $archived = TRUE): EventInterface;

  /**
   * If the entity is archived.
   *
   * @return bool
   *   Whether the entity is archived or not.
   */
  public function isArchived(): bool;

  /**
   * Determines if the entity is deleted.
   *
   * @param bool $deleted
   *   If the entity is deleted.
   *
   * @return $this
   */
  public function setDeleted(bool $deleted = TRUE): EventInterface;

  /**
   * If the entity is deleted.
   *
   * @return bool
   *   Whether the entity is deleted or not.
   */
  public function isDeleted(): bool;

}
