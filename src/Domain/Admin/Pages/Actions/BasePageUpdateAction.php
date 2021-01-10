<?php

namespace Domain\Admin\Pages\Actions;

use Domain\Admin\Pages\Models\Page;
use Src\Translation\Translation;
use System\StateInterface;

/**
 *
 */
abstract class BasePageUpdateAction extends BasePageAction {

  /**
   *
   */
  protected function authorize(): bool {
    // Url cannot be edited if the page is static.
    $inMenu = $this->pageRepository->getInMenu();
    if ($inMenu === Page::PAGE_STATIC
          && $this->url !== $this->pageRepository->getSlug()
      ) {
      $this->session()->flash(
            StateInterface::FAILED,
            sprintf(
                Translation::get('page_static_slug_cannot_be_edited'),
                $this->pageRepository->getSlug()
            )
        );
      return FALSE;
    }

    // Visibility cannot be edited if the page is static.
    if ($inMenu === Page::PAGE_STATIC
          && $this->inMenu !== $inMenu
      ) {
      $this->session()->flash(
            StateInterface::FAILED,
            sprintf(
                Translation::get('page_static_cannot_be_edited'),
                $this->pageRepository->getSlug()
            )
        );
      return FALSE;
    }

    return parent::authorize();
  }

}
