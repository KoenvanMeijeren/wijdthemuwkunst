<?php
declare(strict_types=1);

namespace Modules\Page\Entity;

use Modules\Slug\SlugInterface;
use System\Entity\EntityInterface;

/**
 * Provides an interface for Page entities.
 *
 * @package Modules\Page\Entity
 */
interface PageInterface extends EntityInterface, SlugInterface {

  /**
   * Possible page visibility options.
   *
   * @var int
   */
  public const PAGE_NORMAL = 1;
  public const PAGE_STATIC = 2;

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
   * Sets the in menu value of the entity.
   *
   * @param int $menu
   *   The in menu value.
   *
   * @return $this
   */
  public function setInMenu(int $menu): PageInterface;

  /**
   * Gets the in menu value of the entity.
   *
   * @return int
   *   The in menu value.
   */
  public function getInMenu(): int;

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

  /**
   * Determines if the entity is deleted.
   *
   * @param bool $deleted
   *   If the entity is deleted.
   *
   * @return $this
   */
  public function setDeleted(bool $deleted = TRUE): PageInterface;

  /**
   * If the entity is deleted.
   *
   * @return bool
   *   Whether the entity is deleted or not.
   */
  public function isDeleted(): bool;

}
