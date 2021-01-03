<?php

declare(strict_types=1);

namespace Domain\Admin\Accounts\User\Actions;

use Domain\Admin\Accounts\Repositories\AccountRepository;
use Domain\Admin\Accounts\User\Models\User;
use Src\Action\FormAction;
use System\Request;
use System\StateInterface;
use Src\Session\Session;
use Src\Translation\Translation;
use Src\Validate\form\FormValidator;

/**
 *
 */
abstract class BaseUserAction extends FormAction {
  protected FormValidator $validator;
  protected Session $session;
  protected User $user;
  protected AccountRepository $account;

  protected string $name;
  protected string $currentPassword;
  protected string $newPassword;
  protected string $confirmationPassword;

  protected array $attributes = [];

  /**
   *
   */
  public function __construct() {
    $this->user = new User();
    $this->account = new AccountRepository($this->user->getAccount());
    $this->session = new Session();
    $this->validator = new FormValidator();
    $request = new Request();

    $this->name = $request->post('name');
    $this->currentPassword = $request->post('currentPassword');
    $this->newPassword = $request->post('newPassword');
    $this->confirmationPassword = $request->post(
          'confirmationPassword'
      );
  }

  /**
   * Prepare the attributes to be used for updating the user.
   */
  abstract protected function prepareAttributes(): void;

  /**
   * @inheritDoc
   */
  protected function handle(): bool {
    $this->prepareAttributes();
    $this->user->update($this->account->getId(), $this->attributes);

    $this->session->flash(
          StateInterface::SUCCESSFUL,
          Translation::get('admin_edited_account_successful_message')
      );

    return TRUE;
  }

}
