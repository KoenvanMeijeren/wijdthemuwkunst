<?php

namespace App\Domain\Admin\Text\Actions;

use Src\State\State;
use Src\Translation\Translation;

/**
 *
 */
final class UpdateTextAction extends BaseTextAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->text->update($this->text->getId(), $this->attributes);

    $this->session->flash(
          State::SUCCESSFUL,
          sprintf(
              Translation::get('text_successful_updated'),
              $this->key
          )
      );

    return TRUE;
  }

}
