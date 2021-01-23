<?php

namespace Domain\Admin\Menu\Actions;

use Components\Translation\TranslationOld;
use System\StateInterface;

/**
 *
 */
final class UpdateMenuAction extends BaseMenuAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->menu->update($this->menu->getId(), $this->attributes);

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              TranslationOld::get('menu_item_successful_updated'),
              $this->title
          )
      );

    return TRUE;
  }

}
