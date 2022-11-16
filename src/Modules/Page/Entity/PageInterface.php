<?php
declare(strict_types=1);

namespace Modules\Page\Entity;

use Modules\Slug\SlugInterface;
use System\Entity\EntityInterface;
use System\Entity\Status\EntityStatusInterface;

/**
 * Provides an interface for Page entities.
 *
 * @package Modules\Page\Entity
 */
interface PageInterface extends EntityInterface, SlugInterface, EntityStatusInterface {

  /**
   * Sets the key of the text.
   *
   * @param string $title
   *   The name of the key.
   *
   * @return $this
   */
  public function setTitle(string $title): PageInterface;

  /**
   * Gets the key of the text.
   *
   * @return string|null
   *   The key of the text.
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
  public function setThumbnail(?int $thumbnail): PageInterface;

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
  public function setBanner(?int $banner): PageInterface;

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
  public function setContent(string $content): PageInterface;

  /**
   * Gets the content of the entity.
   *
   * @return string|null
   *   The content of the entity.
   */
  public function getContent(): ?string;

  /**
   * Sets the visibility value of the entity.
   *
   * @param int $visibility
   *   The visibility value.
   *
   * @return $this
   */
  public function setVisibility(int $visibility): PageInterface;

  /**
   * Gets the visibility value of the entity.
   *
   * @return int
   *   The visibility value.
   */
  public function getVisibilityNumeric(): int;

  /**
   * Gets the visibility value of the entity.
   *
   * @return \Modules\Page\Entity\PageVisibility
   *   The visibility value.
   */
  public function getVisibility(): PageVisibility;

  /**
   * Determines if the text is deleted.
   *
   * @param bool $published
   *   If the entity is published.
   *
   * @return $this
   */
  public function setPublished(bool $published = TRUE): PageInterface;

  /**
   * If the entity is published.
   *
   * @return bool
   *   Whether the entity is published or not.
   */
  public function isPublished(): bool;

}
