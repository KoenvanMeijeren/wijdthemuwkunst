<?php

namespace Src\Converter;

/**
 * Provides an interface for converter classes.
 *
 * @package Src\Converter
 */
interface ConvertInterface {

  /**
   * Converts the variable to a readable string for humans.
   *
   * @return string
   *   The readable string.
   */
  public function toReadable(): string;

}
