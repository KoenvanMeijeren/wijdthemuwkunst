<?php
declare(strict_types=1);

namespace Components\Env;

use Components\ComponentsTrait;
use Components\SuperGlobals\Request;
use Components\SuperGlobals\RequestInterface;
use JetBrains\PhpStorm\Pure;
use Components\Log\LoggerHandler;
use Components\Validate\Validate;
use System\View\ProductionErrorView;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;

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
  protected string $host;

  /**
   * The current environment of the app.
   *
   * @var string
   */
  protected string $currentEnvironment;

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
    $host = $this->request()->server(RequestInterface::HTTP_HOST);
    $this->host = $host !== '' ? $host : 'localhost';
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
    $this->currentEnvironment = self::PRODUCTION;
    if (str_contains($this->host, 'localhost') || str_contains($this->host, '127.0.0.1')) {
      $this->currentEnvironment = self::DEVELOPMENT;
    }

    Validate::var($this->currentEnvironment)->isEnv();
  }

  /**
   * {@inheritDoc}
   */
  public function get(): string {
    return $this->currentEnvironment;
  }

  /**
   * {@inheritDoc}
   */
  #[Pure] public function isDevelopment(): bool {
    return $this->get() === self::DEVELOPMENT;
  }

  /**
   * {@inheritDoc}
   */
  #[Pure] public function isProduction(): bool {
    return $this->get() === self::PRODUCTION;
  }

  /**
   * {@inheritDoc}
   */
  public function initializeErrorHandling(): void {
    ini_set('display_errors', (self::DEVELOPMENT === $this->currentEnvironment ? '1' : '0'));
    ini_set('display_startup_errors', (self::DEVELOPMENT === $this->currentEnvironment ? '1' : '0'));
    error_reporting((self::DEVELOPMENT === $this->currentEnvironment ? E_ALL : -1));

    $this->initializeWhoops();
  }

  /**
   * Initializes the whoops error and exception handler.
   */
  protected function initializeWhoops(): void {
    $whoops = new Whoops();
    if (self::DEVELOPMENT === $this->currentEnvironment) {
      $whoops->prependHandler(new PrettyPageHandler());
      $whoops->register();
    }
    elseif (self::PRODUCTION === $this->currentEnvironment) {
      $whoops->prependHandler(new ProductionErrorView());
      $whoops->register();
    }

    $whoops->prependHandler(new LoggerHandler());
    $whoops->register();
  }

}