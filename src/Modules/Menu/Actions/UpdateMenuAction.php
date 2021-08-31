<?php
declare(strict_types=1);

namespace Modules\Menu\Actions;

/**
 * Provides a class for the update menu item action.
 *
 * @package Modules\Menu\Actions
 */
final class UpdateMenuAction extends BaseMenuAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setSlug($this->request()->post('slug'));
    $this->entity->setTitle($this->request()->post('title'));
    $this->entity->setWeight((int) $this->request()->post('weight'));

    return $this->saveEntity();
  }

}
