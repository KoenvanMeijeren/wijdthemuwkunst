<?php

declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

use Components\Translation\TranslationOld;
use Domain\Admin\Pages\Models\Page;
use System\StateInterface;

/**
 *
 */
final class UnPublishPageAction extends BasePageAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->page->update($this->pageRepository->getId(), [
      'page_is_published' => '0',
    ]);

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              TranslationOld::get('page_successfully_unpublished'),
              $this->pageRepository->getSlug()
          )
      );

    return TRUE;
  }

  /**
   * @inheritDoc
   */
  protected function authorize(): bool {
    if ($this->pageRepository->getInMenu() === Page::PAGE_STATIC) {
      $this->session()->flash(
            StateInterface::FAILED,
            TranslationOld::get('page_static_cannot_be_unpublished')
        );

      return FALSE;
    }

    return parent::authorize();
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    return TRUE;
  }

}
