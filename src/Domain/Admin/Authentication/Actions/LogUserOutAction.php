<?php

declare(strict_types=1);


namespace Domain\Admin\Authentication\Actions;

use Components\Actions\Action;
use Components\SuperGlobals\Session\SessionBuilder;
use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\User\Models\User;
use System\StateInterface;

/**
 *
 */
final class LogUserOutAction extends Action {
  private User $user;

  /**
   * {@inheritDoc}
   */
  public function __construct(User $user) {
    $this->user = $user;
  }

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $builder = new SessionBuilder();
    $builder->destroy();
    $builder->startSession();
    $builder->secureSession();

    $this->session()->flash(StateInterface::SUCCESSFUL, TranslationOld::get('admin_logout_message'));

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    return $this->user->isLoggedIn();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    return TRUE;
  }

}
