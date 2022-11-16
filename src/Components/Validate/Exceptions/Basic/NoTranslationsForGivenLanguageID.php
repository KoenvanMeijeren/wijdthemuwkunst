<?php
declare(strict_types=1);

namespace Components\Validate\Exceptions\Basic;

use Exception;

/**
 * Provides an exception for undefined languages.
 *
 * @package Components\File\Exceptions
 */
final class NoTranslationsForGivenLanguageID extends Exception {

  /**
   * NoTranslationsForGivenLanguageID constructor.
   *
   * @param string $language
   *   The language.
   */
  public function __construct(string $language) {
    parent::__construct("No translations where found for the given language with id `{$language}`.");
  }

}
