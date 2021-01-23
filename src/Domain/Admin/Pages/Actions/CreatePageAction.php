<?php

declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

use Components\Translation\TranslationOld;
use System\StateInterface;

/**
 *
 */
final class CreatePageAction extends BasePageAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $page = $this->page->firstOrCreate($this->attributes);

    if ($page === NULL) {
      $this->session()->flash(
            StateInterface::FAILED,
            TranslationOld::get('page_unsuccessfully_created')
        );

      return FALSE;
    }

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              TranslationOld::get('page_successfully_created'),
              $this->url
          )
      );

    return TRUE;
  }

}
