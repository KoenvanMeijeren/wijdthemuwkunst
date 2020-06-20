<?php

declare(strict_types=1);


namespace Src\Core;

use Src\Log\LoggerHandler;
use Src\Validate\Validate;
use System\View\ProductionErrorView;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run as Whoops;

/**
 * The environment handler of the application.
 *
 * @package Src\Core
 */
final class Env {

  /**
   * The environment options.
   *
   * @var string
   */
  public const DEVELOPMENT = 'development';
  public const PRODUCTION = 'production';

  /**
   * The default error page.
   *
   * @var string
   */
  public const ERROR_PAGE = 'http/500-error';

  /**
   * The host of the app.
   *
   * @var string
   */
  private string $host;

  /**
   * The current environment of the app.
   *
   * @var string
   */
  private string $env;

  /**
   * Env constructor.
   */
  public function __construct() {
    $this->setHost();
    $this->set();
  }

  /**
   * Defines the host of the app.
   *
   * @throws \Src\Exceptions\Uri\InvalidDomainException
   */
  private function setHost(): void {
    $request = new Request();

    $host = $request->server(Request::HTTP_HOST);
    $this->host = $host !== '' ? $host : 'localhost';
    Validate::var($this->host)->isDomain();
  }

  /**
   * Returns the host of the app.
   *
   * @return string
   *   The host name.
   */
  public function getHost(): string {
    return $this->host;
  }

  /**
   * Set the current env based on the uri.
   *
   * @throws \Src\Exceptions\Uri\InvalidEnvException
   */
  private function set(): void {
    $this->env = self::PRODUCTION;
    if (strpos($this->host, 'localhost') !== FALSE ||
          strpos($this->host, '127.0.0.1') !== FALSE
      ) {
      $this->env = self::DEVELOPMENT;
    }

    Validate::var($this->env)->isEnv();
  }

  /**
   * Gets the current env.
   *
   * @return string
   */
  public function get(): string {
    return $this->env;
  }

  /**
   * Set the error handling.
   *
   * @return void
   */
  public function setErrorHandling(): void {
    ini_set(
          'display_errors',
          (self::DEVELOPMENT === $this->env ? '1' : '0')
      );
    ini_set(
          'display_startup_errors',
          (self::DEVELOPMENT === $this->env ? '1' : '0')
      );
    error_reporting((self::DEVELOPMENT === $this->env ? E_ALL : -1));

    $this->initializeWhoops();
  }

  /**
   * Initialize the whoops error and exception handler.
   */
  private function initializeWhoops(): void {
    $whoops = new Whoops();
    if (self::DEVELOPMENT === $this->env) {
      $whoops->prependHandler(new PrettyPageHandler());
      $whoops->register();
    }
    elseif (self::PRODUCTION === $this->env) {
      $whoops->prependHandler(new ProductionErrorView());
      $whoops->register();
    }

    $whoops->prependHandler(new LoggerHandler());
    $whoops->register();
  }

}
