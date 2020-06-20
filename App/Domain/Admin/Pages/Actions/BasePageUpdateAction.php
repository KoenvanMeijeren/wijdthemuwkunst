<?php

namespace App\Domain\Admin\Pages\Actions;

use Domain\Admin\Pages\Actions\BasePageAction;
use Domain\Admin\Pages\Models\Page;
use Src\State\State;
use Src\Translation\Translation;

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
      $this->session->flash(
            State::FAILED,
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
      $this->session->flash(
            State::FAILED,
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
