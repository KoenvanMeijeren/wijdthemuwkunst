<?php

namespace App\Domain\Admin\Text\Actions;

use Src\State\State;
use Src\Translation\Translation;

/**
 *
 */
final class CreateTextAction extends BaseTextAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $text = $this->text->firstOrCreate($this->attributes);

    if ($text !== NULL) {
      $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('text_successful_created'),
                $this->key
            )
        );

      return TRUE;
    }

    $this->session->flash(
          State::FAILED,
          sprintf(
              Translation::get('text_unsuccessful_created'),
              $this->key
          )
      );

    return FALSE;
  }

}
