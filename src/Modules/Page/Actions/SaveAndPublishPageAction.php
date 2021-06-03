<?php
declare(strict_types=1);

namespace Modules\Page\Actions;

/**
 * Provides an action for saving and publishing a page.
 *
 * @package Modules\Page\Actions
 */
final class SaveAndPublishPageAction extends BasePageUpdateAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->entity->setPublished(TRUE);

    return parent::handle();
  }

}
