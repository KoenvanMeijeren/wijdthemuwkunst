<?php
declare(strict_types=1);

namespace System;

use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Text\TextModule;
use Components\Env\Env;
use System\Router;
use System\StateInterface;
use Components\SuperGlobals\Url\Uri;
use Components\Header\Header;
use Src\Log\Log;
use Components\SuperGlobals\Session\Session;
use Components\SuperGlobals\Session\SessionBuilder;

/**
 * Provides the main entry point for the application.
 *
 * @package src\Core
 */
final class Application implements ApplicationInterface {

  /**
   * The location of the routes.
   *
   * @var array
   */
  protected array $routesLocations = [];

  /**
   * Construct the app.
   *
   * Set the env based on the current environment (development - production)
   * Start the session and set some basic security protection.
   * Set the user for the application.
   *
   * @param string $routesLocation
   *   The file location of the base routes.
   */
  public function __construct(string $routesLocation = 'web.php') {
    $this->routesLocations[] = ROUTES_PATH . '/' . $routesLocation;
  }

  /**
   * Executes actions before running the app.
   */
  protected function preRun(): void {
    $textModule = new TextModule();

    $this->routesLocations[] = $textModule->getRoutesLocation();

    date_default_timezone_set('Europe/Amsterdam');

    $env = new Env();
    $env->initializeErrorHandling();

    $header = new Header();
    $header->send(Header::X_XSS_PROTECTION);

    $sessionBuilder = new SessionBuilder();
    $sessionBuilder->startSession($env->get());
    $sessionBuilder->secureSession();
  }

  /**
   * Runs the app.
   */
  public function run(): void {
    $this->preRun();

    $user = new User();
    Router::load($this->routesLocations)
      ->direct(Uri::getUrl(), Uri::getMethod(), $user->getRights());

    $this->postRun();
  }

  /**
   * Executes actions after running the app.
   */
  protected function postRun(): void {
    $session = new Session();
    if ($session->exists(StateInterface::FAILED)
      || $session->exists(StateInterface::FORM_VALIDATION_FAILED)
      || $session->exists(StateInterface::SUCCESSFUL)) {
      return;
    }

    Log::appRequest(value: '', state: StateInterface::SUCCESSFUL, url: Uri::getUrl(), method: Uri::getMethod());
  }

}
