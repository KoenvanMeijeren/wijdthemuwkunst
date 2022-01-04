<?php

declare(strict_types=1);

namespace Modules\Authentication\Actions;

use Components\Actions\Action;
use Components\SuperGlobals\Session\SessionBuilder;
use Components\Translation\TranslationOld;
use Modules\User\CurrentUser;
use Modules\User\CurrentUserInterface;
use System\State;

/**
 * Provides an action for logging an user out.
 *
 * @package Modules\Authentication\Actions
 */
final class UserLogOutAction extends Action {

  /**
   * The current user.
   *
   * @var \Modules\User\CurrentUserInterface
   */
  protected CurrentUserInterface $currentUser;

  /**
   * Creates a new log user out action.
   */
  public function __construct() {
    $this->currentUser = new CurrentUser();
  }

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $builder = new SessionBuilder();
    $builder->destroy();
    $builder->startSession($this->env()->get());
    $builder->secureSession();

    $this->session()->flash(State::SUCCESSFUL->value, TranslationOld::get('admin_logout_message'));

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    return $this->currentUser->isLoggedIn();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    return TRUE;
  }

}
