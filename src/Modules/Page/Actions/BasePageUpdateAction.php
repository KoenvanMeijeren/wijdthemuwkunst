<?php

namespace Modules\Page\Actions;

use Components\Translation\TranslationOld;
use Modules\Page\Entity\PageVisibility;
use System\State;

/**
 * Provides a base action for updating pages.
 *
 * @package Modules\Page\Actions
 */
abstract class BasePageUpdateAction extends BasePageAction {

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    // Url cannot be edited if the page is static.
    if (PageVisibility::STATIC->isEqual($this->entity->getVisibility())
      && $this->request()->post('slug') !== $this->entity->getSlug()) {
      $this->session()->flash(
        State::FAILED->value,
        sprintf(TranslationOld::get('page_static_slug_cannot_be_edited'), $this->entity->getSlug())
      );
      return FALSE;
    }

    // Visibility cannot be edited if the page is static.
    $input_visibility = (int) $this->request()->post('visibility');
    if (PageVisibility::STATIC->isEqual($this->entity->getVisibility())
      && $input_visibility !== $this->entity->getVisibilityNumeric()) {
      $this->session()->flash(State::FAILED->value,
        sprintf(TranslationOld::get('page_static_cannot_be_edited'), $this->entity->getSlug())
      );
      return FALSE;
    }

    return parent::authorize();
  }

}
