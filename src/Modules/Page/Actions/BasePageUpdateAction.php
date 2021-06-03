<?php

namespace Modules\Page\Actions;

use Components\Translation\TranslationOld;
use Modules\Page\Entity\PageInterface;
use System\StateInterface;

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
    $inMenu = $this->entity->getInMenu();
    if ($inMenu === PageInterface::PAGE_STATIC && $this->request()->post('slug') !== $this->entity->getSlug()) {
      $this->session()->flash(
        StateInterface::FAILED,
        sprintf(TranslationOld::get('page_static_slug_cannot_be_edited'), $this->entity->getSlug())
      );
      return FALSE;
    }

    // Visibility cannot be edited if the page is static.
    if ($inMenu === PageInterface::PAGE_STATIC && $this->request()->post('menu') !== $inMenu) {
      $this->session()->flash(StateInterface::FAILED,
        sprintf(TranslationOld::get('page_static_cannot_be_edited'), $this->entity->getSlug())
      );
      return FALSE;
    }

    return parent::authorize();
  }

}
