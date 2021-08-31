<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\User\Controllers;

use Components\Header\Redirect;
use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\User\Actions\UpdateUserDataAction;
use Domain\Admin\Accounts\User\Actions\UpdateUserPasswordAction;
use Components\View\ViewInterface;
use System\Controller\AdminControllerBase;

/**
 *
 */
final class UserAccountControllerBase extends AdminControllerBase {
  protected string $redirectBack = '/admin/user/account';

  public function __construct(){
    parent::__construct('Admin/Accounts/User/Views/');
  }

  /**
   * {@inheritDoc}
   */
  public function index(): ViewInterface {
    return $this->view('index', [
      'title' => TranslationOld::get('admin_account_maintenance_title'),
      'account' => $this->currentUser()->getAccount(),
    ]);
  }

  /**
   * @return \Src\Core|DomainView
   */
  public function storeData() {
    $updateUser = new UpdateUserDataAction();
    if ($updateUser->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->index();
  }

  /**
   * @return \Src\Core|DomainView
   */
  public function storePassword() {
    $updateUser = new UpdateUserPasswordAction();
    if ($updateUser->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->index();
  }

}
