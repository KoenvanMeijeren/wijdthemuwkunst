<?php
declare(strict_types=1);

namespace Modules\Page\Actions;

use Components\Translation\TranslationOld;
use Modules\Page\Entity\PageInterface;
use System\State;

/**
 * Provides an action for publishing a page.
 *
 * @package Modules\Page\Actions
 */
final class PublishPageAction extends BasePageAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->entity->setPublished(TRUE);

    return parent::handle();
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    if ($this->entity->getInMenu() === PageInterface::PAGE_STATIC) {
      $this->session()->flash(State::FAILED->value, TranslationOld::get('page_static_cannot_be_published'));

      return FALSE;
    }

    return parent::authorize();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    return TRUE;
  }

}
