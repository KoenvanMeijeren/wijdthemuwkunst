<?php
declare(strict_types=1);

namespace Modules\Page\Actions;

/**
 * Provides an action for removing the page banner.
 *
 * @package Modules\Page\Actions
 */
final class RemovePageBannerAction extends BasePageAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->entity->setBanner(NULL);

    return parent::handle();
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    return TRUE;
  }

}
