<?php

namespace Modules\Event\Entity;

use Cake\Chronos\Chronos;
use Components\Datetime\DateTime;
use Modules\Slug\SlugTrait;
use System\Entity\EntityBase;

/**
 * Defines the Event entity.
 *
 * @package Modules\Event\Entity
 */
final class Event extends EntityBase implements EventInterface {

  use SlugTrait;

  /**
   * {@inheritdoc}
   */
  protected string $table = 'event';

  /**
   * {@inheritdoc}
   */
  protected string $repository = EventRepository::class;

  /**
   * {@inheritDoc}
   */
  public function setTitle(string $title): EventInterface {
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
  public function setThumbnail(?int $thumbnail): EventInterface {
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
  public function setBanner(?int $banner): EventInterface {
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
  public function setContent(string $content): EventInterface {
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
  public function setLocation(string $location): EventInterface {
    $this->set('location', $location);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getLocation(): ?string {
    return $this->get('location');
  }

  /**
   * {@inheritDoc}
   */
  public function setDate(DateTime $dateTime): EventInterface {
    $this->set('date', $dateTime->toFormattedDate());
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getDateTime(): ?string {
    return $this->get('date');
  }

  /**
   * {@inheritDoc}
   */
  public function getDate(): string {
    $datetime = new Chronos($this->getDateTime());

    return $datetime->toDateString();
  }

  /**
   * {@inheritDoc}
   */
  public function getTime(): string {
    $datetime = new Chronos($this->getDateTime());

    return $datetime->toTimeString();
  }

  /**
   * {@inheritDoc}
   */
  public function setPublished(bool $published = TRUE): EventInterface {
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
  public function setArchived(bool $archived = TRUE): EventInterface {
    $this->set('is_archived', (int) $archived);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isArchived(): bool {
    return (bool) $this->get('is_archived');
  }

  /**
   * {@inheritDoc}
   */
  public function setDeleted(bool $deleted = TRUE): EventInterface {
    $this->set('is_deleted', (int) $deleted);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isDeleted(): bool {
    return (bool) $this->get('is_deleted');
  }

}
