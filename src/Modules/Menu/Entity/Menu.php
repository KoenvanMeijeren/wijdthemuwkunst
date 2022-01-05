<?php
declare(strict_types=1);

namespace Modules\Menu\Entity;

use Modules\Slug\SlugTrait;
use System\Entity\EntityBase;
use System\Entity\Status\EntityStatusBase;
use System\Entity\Type\ContentEntityType;

/**
 * Defines the Menu entity.
 *
 * @package Modules\Menu\Entity
 */
#[ContentEntityType(
  table: 'menu',
  repository: MenuRepository::class
)]
final class Menu extends EntityStatusBase implements MenuInterface {

  use SlugTrait;

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
  protected function alterSavableAttributes(): void {
    parent::alterSavableAttributes();

    unset(
      $this->attributes['menu_slug_name'],
      $this->attributes['menu_slug_is_deleted']
    );
  }

}
