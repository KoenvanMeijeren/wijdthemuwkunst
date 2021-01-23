<?php

namespace Domain\Admin\Menu\Actions;

use Components\Translation\TranslationOld;
use System\StateInterface;

/**
 *
 */
final class CreateMenuAction extends BaseMenuAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $menuItem = $this->menu->firstOrCreate($this->attributes);

    if ($menuItem === NULL) {
      $this->session()->flash(
            StateInterface::FAILED,
            sprintf(
                TranslationOld::get('menu_item_unsuccessful_created'),
                $this->title
            )
        );

      return FALSE;
    }

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              TranslationOld::get('menu_item_successful_created'),
              $this->title
          )
      );

    return TRUE;
  }

}
