<?php
declare(strict_types=1);

namespace System;

use Components\ComponentsTrait;
use Components\Datetime\DateTimeInterface;
use Components\Header\Header;
use Components\Route\Router;
use Components\SuperGlobals\Session\SessionBuilder;
use Components\SuperGlobals\Url\Uri;
use System\Module\ModuleHandler;

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
    $moduleHandler = new ModuleHandler();

    $this->routesLocations = array_merge($moduleHandler->getRoutes(), $this->routesLocations);

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
  public function run(): string {
    $this->preRun();

    $current_user = $this->currentUser();

    return (string) Router::load($this->routesLocations)->direct(
      Uri::getUrl(), Uri::getMethod(), $current_user->getRights()
    );
  }

}
