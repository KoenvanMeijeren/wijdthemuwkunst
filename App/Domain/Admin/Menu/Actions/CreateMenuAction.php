<?php

namespace Domain\Admin\Menu\Actions;

use Src\Core\StateInterface;
use Src\Translation\Translation;

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
      $this->session->flash(
            StateInterface::FAILED,
            sprintf(
                Translation::get('menu_item_unsuccessful_created'),
                $this->title
            )
        );

      return FALSE;
    }

    $this->session->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              Translation::get('menu_item_successful_created'),
              $this->title
          )
      );

    return TRUE;
  }

}
