<?php

declare(strict_types=1);


namespace Domain\Admin\Authentication\Controllers;

use Components\Header\Redirect;
use Components\Translation\TranslationOld;
use Domain\Admin\Authentication\Actions\LogUserInAction;
use Domain\Admin\Authentication\Actions\LogUserOutAction;
use System\Controller\AdminControllerBase;

/**
 * The authentication controller.
 *
 * @package Domain\Admin\Authentication\Controllers
 */
final class AuthenticationController extends AdminControllerBase {

  private string $redirectTo = '/admin/dashboard';
  private string $redirectBack = '/admin';

  public function __construct(){
    parent::__construct('Admin/Authentication/Views/');
  }

  /**
   * Load the login page.
   * If the user is already logged in redirect him to the dashboard.
   *
   * @return \Components\Header\Redirect|\Components\View\ViewInterface
   *   Either a redirect response or the login view.
   */
  public function index() {
    if ($this->currentUser()->isLoggedIn()) {
      return new Redirect($this->redirectTo);
    }

    return $this->view('login', [
      'title' => TranslationOld::get('login_page_title'),
    ]);
  }

  /**
   * Tries to log the user in and redirect back or to the specified page.
   *
   * @return \Components\Header\Redirect
   *   The redirect response.
   */
  public function login(): Redirect {
    $login = new LogUserInAction($this->currentUser());
    if ($login->execute()) {
      return new Redirect($this->redirectTo);
    }

    return new Redirect($this->redirectBack);
  }

  /**
   * Logs the current user out and redirect back to specified page.
   *
   * @return \Components\Header\Redirect
   *   The redirect response.
   */
  public function logout(): Redirect {
    $logout = new LogUserOutAction($this->currentUser());
    $logout->execute();

    return new Redirect($this->redirectBack);
  }

}
