<?php
declare(strict_types=1);

namespace Components\Env;

use JetBrains\PhpStorm\Pure;

/**
 * Provides an enumeration for the different application environments.
 *
 * @package \Components\Env
 */
enum Environments: string {
  case DEVELOPMENT = 'development';
  case PRODUCTION = 'production';

  /**
   * Sets the environment.
   *
   * @param string $environment
   *   The status.
   *
   * @return \Components\Env\Environments
   *   The environment.
   *
   * @throws \Components\Env\InvalidEnvironmentException
   */
  public static function set(string $environment): Environments {
    return match ($environment) {
      self::DEVELOPMENT->value => self::DEVELOPMENT,
      self::PRODUCTION->value => self::PRODUCTION,
      default => throw new InvalidEnvironmentException($environment),
    };
  }

  /**
   * Determines if the environment is equal or not.
   *
   * @param string $environment
   *   The environment.
   *
   * @return bool
   *   Whether the environment is equal or not.
   */
  #[Pure]
  public function isEqualString(string $environment): bool {
    return $this->value === $environment;
  }

  /**
   * Determines if the environment is equal or not.
   *
   * @param \Components\Env\Environments $environment
   *   The environment.
   *
   * @return bool
   *   Whether the environment is equal or not.
   */
  #[Pure]
  public function isEqual(Environments $environment): bool {
    return $this->isEqualString($environment->value);
  }
}
