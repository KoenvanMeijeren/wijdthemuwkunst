<?php

declare(strict_types=1);

namespace System\Controller;

use Domain\Admin\Accounts\User\Models\User;
use System\Request;
use Src\Session\Session;
use Src\View\ViewInterface;
use System\Entity\EntityManager;
use System\Entity\EntityManagerInterface;
use System\View\DomainView;

/**
 * Provides a controller base for controllers.
 *
 * @package System\Controller
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
   * @var \System\Request
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
   * The entity manager definition.
   *
   * @var \System\Entity\EntityManagerInterface
   */
  protected EntityManagerInterface $entityManager;

  /**
   * ControllerBase constructor.
   */
  public function __construct() {
    $this->request = new Request();
    $this->session = new Session();
    $this->user = new User();
    $this->entityManager = new EntityManager();
  }

  /**
   * Returns a domain view.
   *
   * @param string $name
   *   The name of the domain view.
   * @param string[] $content
   *   The content of the domain view.
   *
   * @return \Src\View\ViewInterface
   *   The renderable domain view.
   */
  protected function view(string $name, array $content = []): ViewInterface {
    return new DomainView($this->baseViewPath . $name, $content);
  }

  /**
   * Gets the current user.
   *
   * @return \Domain\Admin\Accounts\User\Models\User
   *   The current user of the app.
   */
  protected function getCurrentUser(): User {
    return new User();
  }

}
