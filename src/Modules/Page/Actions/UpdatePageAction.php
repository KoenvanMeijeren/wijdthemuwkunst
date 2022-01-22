<?php
declare(strict_types=1);

namespace Modules\Page\Actions;

/**
 * Provides an action for updating pages.
 *
 * @package Modules\Page\Actions
 */
final class UpdatePageAction extends BasePageUpdateAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setSlug($this->request()->post('slug'));
    $this->entity->setTitle($this->request()->post('title'));
    $this->entity->setContent($this->request()->post('content'));
    $this->entity->setVisibility((int) $this->request()->post('visibility'));
    $this->entity->setPublished((bool) $this->request()->post('published'));

    return parent::handle();
  }

}
