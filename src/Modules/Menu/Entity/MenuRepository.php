<?php

namespace Modules\Menu\Entity;

use Modules\Slug\SlugTrait;
use System\Entity\EntityRepositoryBase;

/**
 * Defines a repository for Menu entities.
 *
 * @package Modules\Setting\Entity
 */
final class MenuRepository extends EntityRepositoryBase implements MenuRepositoryInterface {

  use SlugTrait;

  /**
   * {@inheritDoc}
   */
  protected function addGlobalFilters(): void {
    $this->addSlugJoin($this->query, 'menu_slug_ID');
    $this->addSlugFilter($this->query);

    parent::addGlobalFilters();
  }

}
