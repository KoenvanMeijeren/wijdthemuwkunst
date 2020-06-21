<?php

declare(strict_types=1);


namespace Domain\Admin\Pages\Actions;

use Domain\Admin\Accounts\User\Models\User;
use Src\State\State;
use Src\Translation\Translation;

/**
 *
 */
final class UpdatePageAction extends BasePageUpdateAction {

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->page->update($this->page->getId(), $this->attributes);

    $this->session->flash(
          State::SUCCESSFUL,
          sprintf(
              Translation::get('page_successfully_updated'),
              $this->url
          )
      );

    return TRUE;
  }

  /**
   *
   */
  protected function authorize(): bool {
    $user = new User();
    if ($user->getRights() === User::DEVELOPER) {
      return parent::authorize();
    }

    return parent::authorize();
  }

}
