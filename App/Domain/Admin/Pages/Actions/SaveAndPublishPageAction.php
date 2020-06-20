<?php

namespace App\Domain\Admin\Pages\Actions;

use Src\State\State;
use Src\Translation\Translation;

/**
 *
 */
final class SaveAndPublishPageAction extends BasePageUpdateAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->attributes['page_is_published'] = '1';

    $this->page->updateOrCreate($this->page->getId(), $this->attributes);

    $this->session->flash(
          State::SUCCESSFUL,
          sprintf(
              Translation::get('page_successfully_updated'),
              $this->url
          )
      );

    return TRUE;
  }

  /**
   *
   */
  protected function authorize(): bool {
    if ($this->pageRepository->getId() === 0) {
      return parent::authorize();
    }

    return parent::authorize();
  }

}
