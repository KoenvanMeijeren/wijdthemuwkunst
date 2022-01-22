<?php

namespace Modules\Page\Entity;

use Modules\Slug\SlugTrait;
use System\Entity\EntityRepositoryBase;

/**
 * Defines a repository for Page entities.
 *
 * @package Modules\Page\Entity
 */
final class PageRepository extends EntityRepositoryBase implements PageRepositoryInterface {

  use SlugTrait;

  /**
   * {@inheritDoc}
   */
  protected function addGlobalFilters(): void {
    $this->addSlugJoin($this->query, 'page_slug_ID');
    $this->addSlugFilter($this->query);

    parent::addGlobalFilters();
  }

}
