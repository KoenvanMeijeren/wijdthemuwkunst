<?php
declare(strict_types=1);

namespace Components\Sanitize;

/**
 * Provides an interface for sanitizing data.
 *
 * @package Components\Sanitize
 */
interface SanitizeInterface {

  /**
   * The various variable type options.
   *
   * @var string
   */
  public const TYPE_STRING = 'string';
  public const TYPE_INT = 'integer';
  public const TYPE_FLOAT = 'float';
  public const TYPE_URL = 'url';

  /**
   * Executes the sanitizing of the data and returns it.
   *
   * @return string
   *   The sanitized data.
   */
  public function __toString(): string;

  /**
   * Strips the data to prevent XSS attacks.
   *
   * @return string|float|int|bool
   */
  public function data(): string|float|int|bool;

}
