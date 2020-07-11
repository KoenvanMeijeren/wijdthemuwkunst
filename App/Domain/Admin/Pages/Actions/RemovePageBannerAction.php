<?php

declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

use Src\Core\StateInterface;
use Src\Translation\Translation;

/**
 *
 */
final class RemovePageBannerAction extends BasePageAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->page->update($this->pageRepository->getId(), [
      'page_banner_ID' => '0',
    ]);

    $this->session->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              Translation::get('page_banner_successfully_removed'),
              $this->pageRepository->getSlug()
          )
      );

    return TRUE;
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    return TRUE;
  }

}
