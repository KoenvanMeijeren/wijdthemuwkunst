<?php
declare(strict_types=1);

namespace Modules\Page\Entity;

use Modules\Slug\SlugTrait;
use System\Entity\Status\EntityStatusBase;
use System\Entity\Status\EntityStatusColumn;
use System\Entity\Type\ContentEntityType;

/**
 * Defines the Page entity.
 *
 * @package Modules\Page\Entity
 */
#[EntityStatusColumn('is_deleted')]
#[ContentEntityType(
  table: 'page',
  repository: PageRepository::class
)]
final class Page extends EntityStatusBase implements PageInterface {

  use SlugTrait;

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
    $thumbnail = $this->get('thumbnail_ID');
    if (!is_string($thumbnail)) {
      return NULL;
    }

    return $thumbnail;
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
    $banner = $this->get('banner_ID');
    if (!is_string($banner)) {
      return NULL;
    }

    return $banner;
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
  public function preSave(): void {
    parent::preSave();

    if ($this->getVisibility()->isEqual(PageVisibility::STATIC)) {
      $this->setPublished(true);
    }
  }

  /**
   * {@inheritDoc}
   */
  protected function alterSavableAttributes(): void {
    parent::alterSavableAttributes();

    unset(
      $this->attributes['page_slug_name'],
      $this->attributes['page_slug_is_deleted']
    );
  }

}
