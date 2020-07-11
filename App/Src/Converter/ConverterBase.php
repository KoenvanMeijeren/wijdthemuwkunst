<?php

declare(strict_types=1);


namespace Src\Converter;

/**
 * Provides a base class for classes who wants to convert variables.
 *
 * @package Src\Converter
 */
abstract class ConverterBase implements ConvertInterface {

  /**
   * The variable to be converted.
   *
   * @var mixed
   */
  protected $var;

  /**
   * Converter constructor.
   *
   * @param mixed $var
   *   The variable to be converted.
   */
  public function __construct($var) {
    $this->var = $var;
  }

  /**
   * {@inheritDoc}
   */
  abstract public function toReadable(): string;

}
