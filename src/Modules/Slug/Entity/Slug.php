<?php

namespace Modules\Slug\Entity;

use System\Entity\EntityBase;

/**
 * Defines the Slug entity.
 *
 * @package Modules\Slug\Entity
 */
final class Slug extends EntityBase implements SlugInterface {

  /**
   * {@inheritdoc}
   */
  protected string $table = 'slug';

  /**
   * {@inheritdoc}
   */
  protected string $repository = SlugRepository::class;

  /**
   * {@inheritDoc}
   */
  public function setName(string $name): SlugInterface {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getName(): ?string {
    return $this->get('name');
  }

  /**
   * {@inheritDoc}
   */
  public function setDeleted(bool $deleted = TRUE): SlugInterface {
    $this->set('is_deleted', $deleted);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isDeleted(): bool {
    return (bool) $this->get('is_deleted');
  }

}
