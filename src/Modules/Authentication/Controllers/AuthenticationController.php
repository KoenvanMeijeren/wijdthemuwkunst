<?php
declare(strict_types=1);

namespace Modules\Authentication\Controllers;

use Components\Header\Redirect;
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
   *
   * If the user is already logged in redirect to the dashboard.
   *
   * @return \Components\Header\Redirect|\Components\View\ViewInterface
   *   Either a redirect response or the login view.
   */
  public function index(): ViewInterface|Redirect {
    if ($this->currentUserService()->isLoggedIn()) {
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
    $login = new UserLogInAction();
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
    $logout = new UserLogOutAction();
    $logout->execute();

    return new Redirect($this->redirectBack);
  }

}
