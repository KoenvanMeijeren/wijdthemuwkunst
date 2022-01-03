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
   * Executes actions before running the app.
   *
   * Set the env based on the current environment (development - production)
   * Start the session and set some basic security protection.
   * Set the user for the application.
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

    $current_user = $this->user();

    return (string) Router::load($this->routesLocations)->direct(
      Uri::getUrl(), Uri::getHttpType(), $current_user->getRights()
    );
  }

}
