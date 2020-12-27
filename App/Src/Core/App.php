<?php
declare(strict_types=1);

namespace Src\Core;

use Domain\Admin\Accounts\User\Models\User;
use Domain\Admin\Text\TextModule;
use Src\Header\Header;
use Src\Log\Log;
use Src\Session\Session;
use Src\Session\SessionBuilder;

/**
 * Provides the main entry point for the application.
 *
 * @package Src\Core
 */
final class App {

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

    date_default_timezone_set('Europe/Amsterdam');

    $env = new Env();
    $env->setErrorHandling();

    $header = new Header();
    $header->set(Header::X_XSS_PROTECTION);

    $sessionBuilder = new SessionBuilder();
    $sessionBuilder->startSession($env->get());
    $sessionBuilder->setSessionSecurity();
  }

  /**
   * Executes actions before running the app.
   */
  protected function preRun(): void {
    $textModule = new TextModule();

    $this->routesLocations[] = $textModule->getRoutesLocation();
  }

  /**
   * Runs the app.
   */
  public function run(): void {
    $this->preRun();

    $user = new User();
    Router::load($this->routesLocations)
      ->direct(URI::getUrl(), URI::getMethod(), $user->getRights());

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

    Log::appRequest(value:'', state: StateInterface::SUCCESSFUL, url: URI::getUrl(), method: URI::getMethod());
  }

}
