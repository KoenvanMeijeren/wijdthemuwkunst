<?php
declare(strict_types=1);

namespace Modules\Menu\Actions;

use Components\Translation\TranslationOld;
use System\Entity\EntityInterface;
use System\StateInterface;

/**
 * Provides a class for the delete menu item action.
 *
 * @package Modules\Menu\Actions
 */
final class DeleteMenuAction extends BaseMenuAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $status = $this->entity->delete();
    if ($status === EntityInterface::SAVED_DELETED) {
      $this->session()->flash(StateInterface::SUCCESSFUL,
        sprintf(TranslationOld::get('menu_item_successful_deleted'), $this->entity->getKey())
      );

      return TRUE;
    }

    $this->session()->flash(StateInterface::SUCCESSFUL,
      sprintf(TranslationOld::get('menu_item_unsuccessful_deleted'), $this->entity->getKey())
    );

    return FALSE;
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    return TRUE;
  }

}
