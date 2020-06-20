<?php

declare(strict_types=1);


namespace Src\Core;

use Domain\Admin\Accounts\User\Models\User;
use Src\Header\Header;
use Src\Log\Log;
use Src\Session\Builder as SessionBuilder;
use Src\Session\Session;
use Src\State\State;

/**
 *
 */
final class App {
  private string $routesLocation;

  /**
   * Construct the app.
   *
   * Set the env based on the current environment (development - production)
   * Start the session and set some basic security protection.
   * Set the user for the application.
   *
   * @param string $routesLocation
   *   the routes file location.
   *
   * @throws \Exception
   */
  public function __construct(string $routesLocation = 'web.php') {
    $this->routesLocation = $routesLocation;

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
   * Run the app.
   *
   * @throws \Exception
   */
  public function run(): void {
    $user = new User();
    Router::load($this->routesLocation)
      ->direct(URI::getUrl(), URI::getMethod(), $user->getRights());

    $session = new Session();
    if (!$session->exists(State::FAILED) &&
          !$session->exists(State::SUCCESSFUL)
      ) {
      Log::appRequest(
            '',
            State::SUCCESSFUL,
            URI::getUrl(),
            URI::getMethod()
        );
    }
  }

}
