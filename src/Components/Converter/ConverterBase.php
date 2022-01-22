<?php
declare(strict_types=1);

namespace Components\Converter;

/**
 * Provides a base class for classes who wants to convert variables.
 *
 * @package src\Converter
 */
abstract class ConverterBase implements ConvertInterface {

  /**
   * Converter constructor.
   *
   * @param mixed $var
   *   The variable to be converted.
   */
  public function __construct(protected mixed $var) {}

  /**
   * {@inheritDoc}
   */
  abstract public function toReadable(): string;

}
