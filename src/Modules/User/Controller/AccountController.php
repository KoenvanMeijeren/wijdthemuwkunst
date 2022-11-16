<?php

declare(strict_types=1);


namespace Modules\User\Controller;

use Components\Header\Redirect;
use Components\Route\RouteGet;
use Components\Route\RoutePost;
use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use Modules\User\Actions\BlockAccountAction;
use Modules\User\Actions\CreateAccountAction;
use Modules\User\Actions\DeleteAccountAction;
use Modules\User\Actions\UnblockAccountAction;
use Modules\User\Actions\UpdateAccountDataAction;
use Modules\User\Actions\UpdateAccountEmailAction;
use Modules\User\Actions\UpdateAccountPasswordAction;
use Modules\User\Entity\Account;
use Modules\User\Entity\AccountInterface;
use Modules\User\Entity\AccountTable;
use System\Entity\EntityControllerBase;
use System\State;

/**
 * Provides a controller for account actions.
 *
 * @package Modules\User\Controller
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
final class AccountController extends EntityControllerBase {

  /**
   * The path to redirect to if the users must go back.
   *
   * @var string
   */
  protected string $redirectBack = '/admin/account';

  /**
   * The path to redirect if we do not want to go back.
   *
   * @var string
   */
  protected string $redirectSame = '/admin/account/edit/';

  /**
   * AccountController constructor.
   */
  public function __construct(){
    parent::__construct(entityClass: Account::class, baseViewPath: 'User/Views/');
  }

  #[RouteGet(
    url: 'admin/account',
    rights: RouteRights::ADMIN,
    route: 'entity.account.collection'
  )]
  public function index(): ViewInterface {
    $accountTable = new AccountTable($this->repository->all());

    return $this->view('index', [
      'title' => TranslationOld::get('admin_account_title'),
      'accounts' => $accountTable->get(),
    ]);
  }

  #[RouteGet(
    url: 'admin/account/create',
    rights: RouteRights::ADMIN,
    route: 'entity.account.create'
  )]
  public function create(): ViewInterface {
    return $this->view('create', [
      'title' => TranslationOld::get('admin_create_account_title'),
    ]);
  }

  #[RoutePost(
    url: 'admin/account/create/store',
    rights: RouteRights::ADMIN,
    route: 'entity.account.save'
  )]
  public function store(): ViewInterface|Redirect {
    $create = new CreateAccountAction();
    if ($create->execute()) {
      return new Redirect($this->redirectBack);
    }

    return $this->create();
  }

  #[RouteGet(
    url: 'admin/account/edit/{slug}',
    rights: RouteRights::ADMIN,
    route: 'entity.account.edit'
  )]
  public function edit(): ViewInterface|Redirect {
    $account = $this->repository->loadById((int) $this->request()->getRouteParameter());
    if (!$account instanceof AccountInterface) {
      $this->session()->flash(State::FAILED->value, TranslationOld::get('account_does_not_exists'));

      return new Redirect($this->redirectBack);
    }

    return $this->view('edit', [
      'title' => TranslationOld::get('admin_edit_account_title'),
      'account' => $account,
    ]);
  }

  #[RoutePost(
    url: 'admin/account/edit/{slug}/store/data',
    rights: RouteRights::ADMIN,
    route: 'entity.account.saveData'
  )]
  public function storeData(): ViewInterface|Redirect {
    $account = new UpdateAccountDataAction();
    if ($account->execute()) {
      return new Redirect(
        '/admin/account/edit/' . $this->request()->getRouteParameter()
      );
    }

    return $this->edit();
  }

  #[RoutePost(
    url: 'admin/account/edit/{slug}/store/email',
    rights: RouteRights::ADMIN,
    route: 'entity.account.saveEmail'
  )]
  public function storeEmail(): ViewInterface|Redirect {
    $account = new UpdateAccountEmailAction();
    if ($account->execute()) {
      return new Redirect(
        '/admin/account/edit/' . $this->request()->getRouteParameter()
      );
    }

    return $this->edit();
  }

  #[RoutePost(
    url: 'admin/account/edit/{slug}/store/password',
    rights: RouteRights::ADMIN,
    route: 'entity.account.savePassword'
  )]
  public function storePassword(): ViewInterface|Redirect {
    $account = new UpdateAccountPasswordAction();
    if ($account->execute()) {
      return new Redirect(
        '/admin/account/edit/' . $this->request()->getRouteParameter()
      );
    }

    return $this->edit();
  }

  #[RoutePost(
    url: 'admin/account/block/{slug}',
    rights: RouteRights::ADMIN,
    route: 'entity.account.block'
  )]
  public function block(): Redirect {
    $block = new BlockAccountAction();
    $block->execute();

    return new Redirect(
      '/admin/account/edit/' . $this->request()->getRouteParameter()
    );
  }

  #[RoutePost(
    url: 'admin/account/unblock/{slug}',
    rights: RouteRights::ADMIN,
    route: 'entity.account.unblock'
  )]
  public function unblock(): Redirect {
    $unblock = new UnblockAccountAction();
    $unblock->execute();

    return new Redirect(
      '/admin/account/edit/' . $this->request()->getRouteParameter()
    );
  }

  #[RoutePost(
    url: 'admin/account/delete/{slug}',
    rights: RouteRights::ADMIN,
    route: 'entity.account.destroy'
  )]
  public function destroy(): Redirect {
    $delete = new DeleteAccountAction();
    $delete->execute();

    return new Redirect($this->redirectBack);
  }

}
