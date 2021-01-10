<?php

namespace Domain\Admin\Menu\Actions;

use Src\Translation\Translation;
use System\StateInterface;

/**
 *
 */
final class DestroyMenuAction extends BaseMenuAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->menu->delete($this->menu->getId());

    if ($this->menu->find($this->menu->getId()) !== NULL) {
      $this->session()->flash(
            StateInterface::SUCCESSFUL,
            sprintf(
                Translation::get('menu_item_unsuccessful_deleted'),
                $this->menuRepository->getTitle()
            )
        );

      return FALSE;
    }

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              Translation::get('menu_item_successful_deleted'),
              $this->menuRepository->getTitle()
          )
      );

    return TRUE;
  }

  /**
   *
   */
  protected function validate(): bool {
    return TRUE;
  }

}
