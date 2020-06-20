<?php

declare(strict_types=1);

namespace App\System\Controller;

use Domain\Admin\Accounts\User\Models\User;
use Src\Core\Request;
use Src\Session\Session;
use Src\View\ViewInterface;
use System\View\DomainView;

/**
 * Provides a controller base for controllers.
 *
 * @package App\System\Controller
 */
abstract class ControllerBase implements ControllerInterface {
  /**
   * The base path to the views directory.
   *
   * @var string
   */
  protected string $baseViewPath = '';

  /**
   * The request definition.
   *
   * @var \Src\Core\Request
   */
  protected Request $request;

  /**
   * The session definition.
   *
   * @var \Src\Session\Session
   */
  protected Session $session;

  /**
   * The user definition.
   *
   * @var \Domain\Admin\Accounts\User\Models\User
   */
  protected User $user;

  /**
   * ControllerBase constructor.
   */
  public function __construct() {
    $this->request = new Request();
    $this->session = new Session();
    $this->user = new User();
  }

  /**
   * Returns a domain view.
   *
   * @param string $name
   * @param string[] $content
   *
   * @return \Src\View\ViewInterface
   */
  protected function view(string $name, array $content = []): ViewInterface {
    return new DomainView($this->baseViewPath . $name, $content);
  }

  /**
   * Gets the current user.
   *
   * @return \Domain\Admin\Accounts\User\Models\User
   */
  protected function getCurrentUser(): User {
    return new User();
  }

}
