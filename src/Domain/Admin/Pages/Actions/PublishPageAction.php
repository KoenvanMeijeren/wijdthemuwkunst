<?php

declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

use Domain\Admin\Pages\Models\Page;
use Src\Translation\Translation;
use System\StateInterface;

/**
 *
 */
final class PublishPageAction extends BasePageAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->page->update($this->pageRepository->getId(), [
      'page_is_published' => '1',
    ]);

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              Translation::get('page_successfully_published'),
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
            Translation::get('page_static_cannot_be_published')
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
