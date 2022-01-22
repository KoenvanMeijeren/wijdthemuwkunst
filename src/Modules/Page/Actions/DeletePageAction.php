<?php
declare(strict_types=1);

namespace Modules\Page\Actions;

use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use Modules\Page\Entity\PageVisibility;
use System\State;

/**
 * Provides an action for deleting pages.
 *
 * @package Modules\Page\Actions
 */
final class DeletePageAction extends BasePageAction {

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $slug = $this->entity->getTitle();
    $this->entity->delete();

    if ($this->entityManager->getStorage($this->getEntityType())->load($this->entity->id()) !== NULL) {
      $this->session()->flash(
        State::FAILED->value,
        sprintf(TranslationOld::get('page_unsuccessfully_deleted'), $slug)
      );

      return FALSE;
    }

    $this->session()->flash(
      State::SUCCESSFUL->value,
      sprintf(TranslationOld::get('page_successfully_deleted'), $slug)
    );

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    if ($this->user()->getRouteRights()->hasAccessForbidden(RouteRights::DEVELOPER)
      && $this->entity->getVisibility()->isEqual(PageVisibility::STATIC)) {
      $this->session()->flash(
        State::FAILED->value,
        sprintf(TranslationOld::get('page_static_cannot_be_deleted'), $this->entity->getSlug())
      );

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
