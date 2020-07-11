<?php

namespace Domain\Admin\Text\Actions;

use Src\Core\StateInterface;
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
          StateInterface::SUCCESSFUL,
          sprintf(
              Translation::get('text_successful_updated'),
              $this->key
          )
      );

    return TRUE;
  }

}
