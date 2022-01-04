<?php
declare(strict_types=1);

namespace Modules\Menu\Actions;

use Components\Translation\TranslationOld;
use System\Entity\EntityInterface;
use System\State;

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
      $this->session()->flash(State::SUCCESSFUL->value,
        sprintf(TranslationOld::get('menu_item_successful_deleted'), $this->entity->getTitle())
      );

      return TRUE;
    }

    $this->session()->flash(State::SUCCESSFUL->value,
      sprintf(TranslationOld::get('menu_item_unsuccessful_deleted'), $this->entity->getTitle())
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
