<?php

declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Pages\Models\Page;
use System\StateInterface;
use Src\Translation\Translation;

/**
 *
 */
final class DeletePageAction extends BasePageAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->page->delete($this->page->getId());

    if ($this->page->find($this->page->getId()) !== NULL) {
      $this->session->flash(
            StateInterface::FAILED,
            sprintf(
                Translation::get('page_unsuccessfully_deleted'),
                $this->pageRepository->getSlug()
            )
        );

      return FALSE;
    }

    $this->session->flash(
          StateInterface::SUCCESSFUL,
          sprintf(
              Translation::get('page_successfully_deleted'),
              $this->pageRepository->getSlug()
          )
      );

    return TRUE;
  }

  /**
   *
   */
  protected function authorize(): bool {
    $user = new User();

    if ($user->getRights() !== User::DEVELOPER &&
          $this->pageRepository->getInMenu() === Page::PAGE_STATIC
      ) {
      $this->session->flash(
            StateInterface::FAILED,
            sprintf(
                Translation::get('page_static_cannot_be_deleted'),
                $this->pageRepository->getSlug()
            )
        );
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
