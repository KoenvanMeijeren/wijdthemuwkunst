<?php
declare(strict_types=1);

namespace Modules\Page\Actions;

/**
 * Provides an action for removing the page thumbnail.
 *
 * @package Modules\Page\Actions
 */
final class RemovePageThumbnailAction extends BasePageAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setThumbnail(NULL);

    return parent::handle();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    return TRUE;
  }

}
