<?php
declare(strict_types=1);

namespace System;

use Components\ComponentsTrait;
use Components\Datetime\DateTimeInterface;
use Domain\Admin\Accounts\User\Models\User;
use Modules\Text\TextModule;
use Components\SuperGlobals\Url\Uri;
use Components\Header\Header;
use Components\SuperGlobals\Session\SessionBuilder;

/**
 * Provides the main entry point for the application.
 *
 * @package System
 */
final class Application implements ApplicationInterface {

  use ComponentsTrait;

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

    date_default_timezone_set(DateTimeInterface::DEFAULT_TIMEZONE);

    $this->env()->initializeErrorHandling();
    $this->header()->send(Header::X_XSS_PROTECTION);

    $sessionBuilder = new SessionBuilder();
    $sessionBuilder->startSession($this->env()->get());
    $sessionBuilder->secureSession();
  }

  /**
   * {@inheritDoc}
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
    if ($this->session()->exists(StateInterface::FAILED)
      || $this->session()->exists(StateInterface::FORM_VALIDATION_FAILED)
      || $this->session()->exists(StateInterface::SUCCESSFUL)) {
      return;
    }

    $this->logger()->appRequest(value: '', state: StateInterface::SUCCESSFUL, url: Uri::getUrl(), method: Uri::getMethod());
  }

}
