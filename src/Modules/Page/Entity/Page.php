<?php

namespace Modules\Page\Entity;

use Modules\Slug\SlugTrait;
use System\Entity\EntityBase;

/**
 * Defines the Page entity.
 *
 * @package Modules\Page\Entity
 */
final class Page extends EntityBase implements PageInterface {

  use SlugTrait;

  /**
   * {@inheritdoc}
   */
  protected string $table = 'page';

  /**
   * {@inheritdoc}
   */
  protected string $repository = PageRepository::class;

  /**
   * {@inheritDoc}
   */
  public function setTitle(string $title): PageInterface {
    $this->set('title', $title);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getTitle(): ?string {
    return $this->get('title');
  }

  /**
   * {@inheritDoc}
   */
  public function setThumbnail(?int $thumbnail): PageInterface {
    $this->set('thumbnail_ID', $thumbnail);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getThumbnail(): ?string {
    return $this->get('thumbnail_ID');
  }

  /**
   * {@inheritDoc}
   */
  public function setBanner(?int $banner): PageInterface {
    $this->set('banner_ID', $banner);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getBanner(): ?string {
    return $this->get('banner_ID');
  }

  /**
   * {@inheritDoc}
   */
  public function setContent(string $content): PageInterface {
    $this->set('content', $content);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getContent(): ?string {
    return $this->get('content');
  }

  /**
   * {@inheritDoc}
   */
  public function setVisibility(int $visibility): PageInterface {
    $this->set('in_menu', $visibility);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getVisibilityNumeric(): int {
    return (int) $this->get('in_menu');
  }

  /**
   * {@inheritDoc}
   */
  public function getVisibility(): PageVisibility {
    return PageVisibility::set($this->getVisibilityNumeric());
  }

  /**
   * {@inheritDoc}
   */
  public function setPublished(bool $published = TRUE): PageInterface {
    $this->set('is_published', (int) $published);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isPublished(): bool {
    return (bool) $this->get('is_published');
  }

  /**
   * {@inheritDoc}
   */
  public function setDeleted(bool $deleted = TRUE): PageInterface {
    $this->set('is_deleted', (int) $deleted);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isDeleted(): bool {
    return (bool) $this->get('is_deleted');
  }

  /**
   * {@inheritDoc}
   */
  public function preSave(): void {
    parent::preSave();

    if ($this->getVisibility()->isEqual(PageVisibility::PAGE_STATIC)) {
      $this->setPublished(true);
    }
  }

  /**
   * {@inheritDoc}
   */
  protected function alterSavableAttributes(): void {
    parent::alterSavableAttributes();

    $this->removeSlugAttributesForSaving($this->attributes);
  }

}
