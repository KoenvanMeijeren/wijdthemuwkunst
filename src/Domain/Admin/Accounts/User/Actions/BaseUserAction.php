<?php

declare(strict_types=1);

namespace Domain\Admin\Accounts\User\Actions;

use Components\Actions\FormAction;
use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\Repositories\AccountRepository;
use Domain\Admin\Accounts\User\Models\User;
use Components\Validate\FormValidator;
use System\StateInterface;

/**
 *
 */
abstract class BaseUserAction extends FormAction {

  protected FormValidator $validator;
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
    $this->validator = new FormValidator();

    $this->name = $this->request()->post('name');
    $this->currentPassword = $this->request()->post('currentPassword');
    $this->newPassword = $this->request()->post('newPassword');
    $this->confirmationPassword = $this->request()->post(
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

    $this->session()->flash(
          StateInterface::SUCCESSFUL,
          TranslationOld::get('admin_edited_account_successful_message')
      );

    return TRUE;
  }

}
