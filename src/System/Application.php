<?php
declare(strict_types=1);

namespace System;

use Components\ComponentsTrait;
use Components\Datetime\DateTimeInterface;
use Components\Header\Header;
use Components\Route\RouteProcessor;
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
   * Executes actions before running the app.
   *
   * Set the env based on the current environment (development - production)
   * Start the session and set some basic security protection.
   * Set the user for the application.
   */
  protected function preRun(): void {
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
  public function run(): never {
    $this->preRun();

    $moduleHandler = new ModuleHandler();

    $current_user = $this->user();
    $route_processor = new RouteProcessor($moduleHandler->getRouteCollection());

    echo $route_processor->direct(Uri::getUrl(), Uri::getHttpType(), $current_user->getRouteRights());
    exit();
  }

}
