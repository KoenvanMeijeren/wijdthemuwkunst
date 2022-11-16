<?php

declare(strict_types=1);

namespace Modules\User\Controller;

use Components\Header\Redirect;
use Components\Route\RouteGet;
use Components\Route\RoutePost;
use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use Modules\User\Actions\UpdateUserDataAction;
use Modules\User\Actions\UpdateUserPasswordAction;
use Modules\User\Entity\Account;
use System\Entity\EntityControllerBase;

/**
 * Provides a controller for account actions.
 *
 * @package Modules\User\Controller
 */
final class UserAccountController extends EntityControllerBase {

  /**
   * The path to redirect if we do not want to go back.
   *
   * @var string
   */
  protected string $redirectBack = '/admin/user/account';

  /**
   * {@inheritDoc}
   */
  public function __construct(){
    parent::__construct(entityClass: Account::class, baseViewPath: 'User/Views/');
  }

  #[RouteGet(
    url: 'admin/user/account',
    rights: RouteRights::ADMIN,
    route: 'entity.user.index'
  )]
  public function index(): ViewInterface {
    return $this->view('user', [
      'title' => TranslationOld::get('admin_account_maintenance_title'),
      'account' => $this->currentUserService()->get(),
    ]);
  }

  #[RoutePost(
    url: 'admin/user/account/store/data',
    rights: RouteRights::ADMIN,
    route: 'entity.user.saveData'
  )]
  public function storeData(): ViewInterface|Redirect {
    $updateUser = new UpdateUserDataAction();
    if ($updateUser->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->index();
  }

  #[RoutePost(
    url: 'admin/user/account/store/password',
    rights: RouteRights::ADMIN,
    route: 'entity.user.savePassword'
  )]
  public function storePassword(): ViewInterface|Redirect {
    $updateUser = new UpdateUserPasswordAction();
    if ($updateUser->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->index();
  }

}
