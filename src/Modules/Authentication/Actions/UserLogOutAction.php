<?php
declare(strict_types=1);

namespace Modules\Authentication\Actions;

use Components\Actions\Action;
use Components\SuperGlobals\Session\SessionBuilder;
use Components\Translation\TranslationOld;
use Modules\User\CurrentUserInterface;
use Modules\User\Entity\AccountInterface;
use System\State;

/**
 * Provides an action for logging an user out.
 *
 * @package Modules\Authentication\Actions
 */
final class UserLogOutAction extends Action {

  /**
   * The currentUser.
   *
   * @var \Modules\User\Entity\AccountInterface
   */
  protected readonly AccountInterface $currentUser;

  /**
   * Constructs a new object.
   */
  public function __construct(
    protected readonly CurrentUserInterface $currentUserService
  ) {
    $this->currentUser = $this->currentUserService->get();
  }

  /**
   * {@inheritDoc}
   */
  protected function handle(): bool {
    $this->currentUser->setLoginToken(NULL)->save();
    $builder = new SessionBuilder();
    $builder->restart();

    $this->session()->flash(State::SUCCESSFUL->value, TranslationOld::get('admin_logout_message'));

    return TRUE;
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    return $this->currentUserService->isLoggedIn();
  }

  /**
   * {@inheritDoc}
   */
  protected function validate(): bool {
    return TRUE;
  }

}
