<?php
declare(strict_types=1);

namespace Src\Validate;

/**
 * Provides a class for validation actions.
 *
 * @package src\Validate
 */
final class Validate implements ValidateInterface
{

  use BasicValidation;
  use FileValidation;
  use ObjectValidation;
  use UriValidation;

  /**
   * The var to be validated.
   *
   * @var mixed
   */
  private static $var;

  /**
   * {@inheritDoc}
   */
  public static function var(mixed $var): Validate {
    self::$var = $var;

    return new self();
  }

}
