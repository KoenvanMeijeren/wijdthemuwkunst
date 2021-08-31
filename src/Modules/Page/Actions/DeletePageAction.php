<?php
declare(strict_types=1);

namespace Modules\Page\Actions;

use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\User\Models\User;
use Modules\Page\Entity\PageInterface;
use System\StateInterface;

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
        StateInterface::FAILED,
        sprintf(TranslationOld::get('page_unsuccessfully_deleted'), $slug)
      );

      return FALSE;
    }

    $this->session()->flash(
      StateInterface::SUCCESSFUL,
      sprintf(TranslationOld::get('page_successfully_deleted'), $slug)
    );

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    $user = new User();

    if ($user->getRights() !== User::DEVELOPER && $this->entity->getInMenu() === PageInterface::PAGE_STATIC) {
      $this->session()->flash(
        StateInterface::FAILED,
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
