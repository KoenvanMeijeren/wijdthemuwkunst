<?php

namespace Components\Env;


/**
 * Provides an interfaces for environment handlers of the application.
 *
 * @package Components\Env
 */
interface EnvInterface {

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
   * Returns the host of the app.
   *
   * @return string
   *   The host name.
   */
  public function getHost(): string;

  /**
   * Gets the current env.
   *
   * @return string
   *   The current environment.
   */
  public function get(): string;

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
