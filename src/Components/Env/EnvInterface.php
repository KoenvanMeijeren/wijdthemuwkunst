<?php

namespace Components\Env;


/**
 * Provides an interfaces for environment handlers of the application.
 *
 * @package Components\Env
 */
interface EnvInterface {

  /**
   * The various localhost strings.
   *
   * @var string
   */
  public const LOCALHOST_STRING = 'localhost';
  public const LOCALHOST_NUMERIC = '127.0.0.1';

  /**
   * The default error page.
   *
   * @var string
   */
  public const ERROR_PAGE = 'http/500-error';

  /**
   * Returns the host of the app.
   *
   * @return string
   *   The host.
   */
  public function getHost(): string;

  /**
   * Gets the current env.
   *
   * @return \Components\Env\Environments
   *   The current environment.
   */
  public function get(): Environments;

  /**
   * Determines if the env is in development.
   *
   * @return bool
   *   If the env is development.
   */
  public function isDevelopment(): bool;

  /**
   * Determines if the env is in production.
   *
   * @return bool
   *   If the env is production.
   */
  public function isProduction(): bool;

  /**
   * Sets the error handling.
   */
  public function initializeErrorHandling(): void;

}
