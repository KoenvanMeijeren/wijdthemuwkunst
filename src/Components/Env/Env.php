<?php
declare(strict_types=1);

namespace Components\Env;

use Components\ComponentsTrait;
use Components\SuperGlobals\ServerOptions;
use Components\Validate\Validate;
use JetBrains\PhpStorm\Pure;
use Spatie\Ignition\Ignition;

/**
 * The environment handler of the application.
 *
 * @package Components\Env
 */
final class Env implements EnvInterface {

  use ComponentsTrait;

  /**
   * The host of the app.
   *
   * @var string
   */
  public readonly string $host;

  /**
   * The current environment of the app.
   *
   * @var \Components\Env\Environments
   */
  public readonly Environments $current;

  /**
   * Env constructor.
   */
  public function __construct() {
    $this->setHost();
    $this->initialize();
  }

  /**
   * Defines the host of the app.
   */
  protected function setHost(): void {
    $host = $this->request()->server->get(ServerOptions::HTTP_HOST);
    $this->host = $host !== '' ? $host : self::LOCALHOST_STRING;
    Validate::var($this->host)->isDomain();
  }

  /**
   * {@inheritDoc}
   */
  public function getHost(): string {
    return $this->host;
  }

  /**
   * Initializes the current env based on the current uri.
   */
  protected function initialize(): void {
    $enviroment = Environments::PRODUCTION;
    if (str_contains($this->host, self::LOCALHOST_STRING) || str_contains($this->host, self::LOCALHOST_NUMERIC)) {
      $enviroment = Environments::DEVELOPMENT;
    }

    $this->current = $enviroment;
    Validate::var($this->current)->isEnv();
  }

  /**
   * {@inheritDoc}
   */
  public function get(): Environments {
    return $this->current;
  }

  /**
   * {@inheritDoc}
   */
  #[Pure] public function isDevelopment(): bool {
    return $this->current->isEqual(Environments::DEVELOPMENT);
  }

  /**
   * {@inheritDoc}
   */
  #[Pure] public function isProduction(): bool {
    return $this->current->isEqual(Environments::PRODUCTION);
  }

  /**
   * {@inheritDoc}
   */
  public function initializeErrorHandling(): void {
    ini_set('display_errors', ($this->current->isEqual(Environments::DEVELOPMENT) ? '1' : '0'));
    ini_set('display_startup_errors', ($this->current->isEqual(Environments::DEVELOPMENT) ? '1' : '0'));
    error_reporting(($this->current->isEqual(Environments::DEVELOPMENT) ? E_ALL : -1));

    $this->initializeIgnition();
  }

  /**
   * Initializes the whoops error and exception handler.
   */
  protected function initializeIgnition(): void {
    Ignition::make()
      ->shouldDisplayException($this->isDevelopment())
      ->register();
  }

}
