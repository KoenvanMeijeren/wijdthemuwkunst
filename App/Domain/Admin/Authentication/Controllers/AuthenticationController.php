<?php

declare(strict_types=1);


namespace Domain\Admin\Authentication\Controllers;

use App\System\Controller\AdminControllerBase;
use Domain\Admin\Authentication\Actions\LogUserInAction;
use Domain\Admin\Authentication\Actions\LogUserOutAction;
use Src\Response\Redirect;
use Src\Translation\Translation;

/**
 * The authentication controller.
 *
 * @package Domain\Admin\Authentication\Controllers
 */
final class AuthenticationController extends AdminControllerBase {

  protected string $baseViewPath = 'Admin/Authentication/Views/';
  private string $redirectTo = '/admin/dashboard';
  private string $redirectBack = '/admin';

  /**
   * Load the login page.
   * If the user is already logged in redirect him to the dashboard.
   *
   * @return \Src\Response\Redirect|\Src\View\ViewInterface
   *
   * @throws \Src\Exceptions\Basic\InvalidKeyException
   */
  public function index() {
    if ($this->user->isLoggedIn()) {
      return new Redirect($this->redirectTo);
    }

    return $this->view('login', [
      'title' => Translation::get('login_page_title'),
    ]);
  }

  /**
   * Tries to log the user in and redirect back or to the specified page.
   *
   * @return \Src\Response\Redirect
   *   The redirect response.
   */
  public function login(): Redirect {
    $login = new LogUserInAction($this->user);
    if ($login->execute()) {
      return new Redirect($this->redirectTo);
    }

    return new Redirect($this->redirectBack);
  }

  /**
   * Logs the current user out and redirect back to specified page.
   *
   * @return \Src\Response\Redirect
   *   The redirect response.
   */
  public function logout(): Redirect {
    $logout = new LogUserOutAction($this->user);
    $logout->execute();

    return new Redirect($this->redirectBack);
  }

}
