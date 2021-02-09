<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Controllers;

use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\Account\Actions\BlockAccountAction;
use Domain\Admin\Accounts\Account\Actions\CreateAccountAction;
use Domain\Admin\Accounts\Account\Actions\DeleteAccountAction;
use Domain\Admin\Accounts\Account\Actions\UnblockAccountAction;
use Domain\Admin\Accounts\Account\Actions\UpdateAccountDataAction;
use Domain\Admin\Accounts\Account\Actions\UpdateAccountEmailAction;
use Domain\Admin\Accounts\Account\Actions\UpdateAccountPasswordAction;
use Domain\Admin\Accounts\Account\Models\Account;
use Domain\Admin\Accounts\Account\ViewModels\AccountTable;
use Domain\Admin\Accounts\Account\ViewModels\EditViewModel;
use Src\Core\Redirect;
use Components\View\ViewInterface;
use System\Controller\AdminControllerBase;

/**
 * Provides a controller for account actions.
 *
 * @package Domain\Admin\Accounts\Account\Controllers
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
final class AccountController extends AdminControllerBase {

  protected Account $account;
  protected string $redirectBack = '/admin/account';

  /**
   *
   */
  public function __construct() {
    parent::__construct('Admin/Accounts/Account/Views/');

    $this->account = new Account();
  }

  /**
   *
   */
  public function index(): ViewInterface {
    $accountTable = new AccountTable($this->account->all());

    return $this->view('index', [
      'title' => TranslationOld::get('admin_account_title'),
      'accounts' => $accountTable->get(),
    ]);
  }

  /**
   *
   */
  public function create(): ViewInterface {
    return $this->view('create', [
      'title' => TranslationOld::get('admin_create_account_title'),
    ]);
  }

  /**
   * @return \Src\Core|DomainView
   */
  public function store() {
    $create = new CreateAccountAction();
    if ($create->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->create();
  }

  /**
   * @return \Src\Core|DomainView
   * @throws \Components\Validate\Exceptions\Basic\InvalidKeyException
   */
  public function edit() {
    $accountViewModel = new EditViewModel(
          $this->account->find($this->account->getId())
      );

    return $this->view('edit', [
      'title' => TranslationOld::get('admin_edit_account_title'),
      'account' => $accountViewModel->get(),
    ]);
  }

  /**
   * @return \Src\Core|DomainView
   * @throws \Components\Validate\Exceptions\Basic\InvalidKeyException
   */
  public function storeData() {
    $account = new UpdateAccountDataAction();
    if ($account->execute()) {
      return new Redirect(
            '/admin/account/edit/' . $this->account->getId()
        );
    }

    return $this->edit();
  }

  /**
   * @return \Src\Core|DomainView
   * @throws \Components\Validate\Exceptions\Basic\InvalidKeyException
   */
  public function storeEmail() {
    $account = new UpdateAccountEmailAction();
    if ($account->execute()) {
      return new Redirect(
            '/admin/account/edit/' . $this->account->getId()
        );
    }

    return $this->edit();
  }

  /**
   * @return \Src\Core|DomainView
   * @throws \Components\Validate\Exceptions\Basic\InvalidKeyException
   */
  public function storePassword() {
    $account = new UpdateAccountPasswordAction();
    if ($account->execute()) {
      return new Redirect(
            '/admin/account/edit/' . $this->account->getId()
        );
    }

    return $this->edit();
  }

  /**
   *
   */
  public function block(): Redirect {
    $block = new BlockAccountAction();
    $block->execute();

    return new Redirect(
          '/admin/account/edit/' . $this->account->getId()
      );
  }

  /**
   *
   */
  public function unblock(): Redirect {
    $unblock = new UnblockAccountAction();
    $unblock->execute();

    return new Redirect(
          '/admin/account/edit/' . $this->account->getId()
      );
  }

  /**
   *
   */
  public function destroy(): Redirect {
    $delete = new DeleteAccountAction();
    $delete->execute();

    return new Redirect($this->redirectBack);
  }

}
