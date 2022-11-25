<?php
declare(strict_types=1);

namespace Modules\Authentication\Controllers;

use Components\Header\Redirect;
use Components\Route\RouteGet;
use Components\Route\RoutePost;
use Components\Route\RouteRights;
use Components\Translation\TranslationOld;
use Components\View\ViewInterface;
use JetBrains\PhpStorm\Pure;
use Modules\Authentication\Actions\UserLogInAction;
use Modules\Authentication\Actions\UserLogOutAction;
use System\Controller\ControllerBase;

/**
 * The authentication controller.
 *
 * @package Modules\Authentication\Controllers
 */
final class AuthenticationController extends ControllerBase {

  /**
   * The redirect to destination.
   *
   * @var string
   */
  protected readonly string $redirectTo;

  /**
   * The redirect back destination.
   *
   * @var string
   */
  protected readonly string $redirectBack;

  /**
   * {@inheritDoc}
   */
  #[Pure] public function __construct() {
    parent::__construct('Authentication/Views/');

    $this->redirectBack = '/admin';
    $this->redirectTo = '/admin/dashboard';
  }

  /**
   * Loads the login page.
   */
  #[RouteGet(url: 'admin')]
  public function index(): ViewInterface|Redirect {
    if ($this->currentUserService()->isLoggedIn()) {
      return new Redirect($this->redirectTo);
    }

    return $this->view('login', [
      'title' => TranslationOld::get('login_page_title'),
    ]);
  }

  /**
   * Logs the user in.
   */
  #[RoutePost(url: 'admin/login')]
  public function login(): Redirect {
    $login = new UserLogInAction();
    if ($login->execute()) {
      return new Redirect($this->redirectTo);
    }

    return new Redirect($this->redirectBack);
  }

  /**
   * Logs the current user out.
   */
  #[RouteGet(url: 'admin/logout', rights: RouteRights::ADMIN)]
  public function logout(): Redirect {
    $logout = new UserLogOutAction($this->currentUserService());
    $logout->execute();

    return new Redirect($this->redirectBack);
  }

}
