<?php
declare(strict_types=1);

namespace Modules\Page\Actions;

use Components\Translation\TranslationOld;
use Modules\Page\Entity\PageInterface;
use System\StateInterface;

/**
 * Provides an action for un-publishing a page.
 *
 * @package Modules\Page\Actions
 */
final class UnPublishPageAction extends BasePageAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setPublished(FALSE);

    return parent::handle();
  }

  /**
   * @inheritDoc
   */
  protected function authorize(): bool {
    if ($this->entity->getInMenu() === PageInterface::PAGE_STATIC) {
      $this->session()->flash(StateInterface::FAILED, TranslationOld::get('page_static_cannot_be_unpublished'));

      return FALSE;
    }

    return parent::authorize();
  }

  /**
   * @inheritDoc
   */
  protected function validate(): bool {
    return TRUE;
  }

}
