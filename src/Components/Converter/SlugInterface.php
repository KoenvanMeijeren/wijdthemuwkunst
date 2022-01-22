<?php

namespace Components\Converter;


/**
 * Encodes a string into a url-save string.
 *
 * @package Components\Converter
 */
interface SlugInterface {

  /**
   * Encode a string into a url-save string.
   *
   * Test string: Mess'd up --text-- just (to) stress /test/ ?our! `little` \\clean\\ url fun.ction!?-->
   *
   * @return string
   *   The safely encoded url string.
   */
  public function parse(): string;

}
