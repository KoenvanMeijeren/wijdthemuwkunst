<?php
declare(strict_types=1);

namespace Components\Converter;

/**
 * Encodes a string into a url-save string.
 *
 * @package Components\Converter
 */
final class Slug implements SlugInterface {

  /**
   * Slug constructor.
   *
   * @param string $slug
   *   The slug to be parsed.
   */
  public function __construct(
    protected string $slug
  ) {}

  /**
   * {@inheritDoc}
   */
  public function parse(): string {
    return encode_url($this->slug);
  }

}
