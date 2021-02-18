<?php
declare(strict_types=1);

namespace Modules\Menu\Entity;

use Modules\Slug\SlugTrait;
use System\Entity\EntityBase;

/**
 * Defines the Menu entity.
 *
 * @package Modules\Menu\Entity
 */
final class Menu extends EntityBase implements MenuInterface {

  use SlugTrait;

  /**
   * {@inheritdoc}
   */
  protected string $table = 'menu';

  /**
   * {@inheritdoc}
   */
  protected string $repository = MenuRepository::class;

  /**
   * {@inheritDoc}
   */
  public function setTitle(string $title): MenuInterface {
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
  public function setWeight(int $weight): MenuInterface {
    $this->set('weight', $weight);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getWeight(): ?string {
    return (string) $this->get('weight');
  }

  /**
   * {@inheritDoc}
   */
  public function setDeleted(bool $deleted = TRUE): MenuInterface {
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
