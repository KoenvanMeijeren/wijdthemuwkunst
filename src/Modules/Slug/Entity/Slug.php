<?php
declare(strict_types=1);

namespace Modules\Slug\Entity;

use System\Entity\Status\EntityStatusBase;
use System\Entity\Type\ContentEntityType;

/**
 * Defines the Slug entity.
 *
 * @package Modules\Slug\Entity
 */
#[ContentEntityType(
  table: 'slug',
  repository: SlugRepository::class
)]
final class Slug extends EntityStatusBase implements SlugInterface {

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

}
