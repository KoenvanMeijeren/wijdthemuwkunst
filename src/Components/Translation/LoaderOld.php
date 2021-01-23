<?php
declare(strict_types=1);

namespace Components\Translation;

use Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;

/**
 * Provides a loader for the translations.
 *
 * @package Components\Translation
 * @deprecated
 */
abstract class LoaderOld {
  /**
   * The language options.
   *
   * @var int
   */
  public const DUTCH_LANGUAGE_ID = 1;
  public const DUTCH_LANGUAGE_CODE = 'nl';
  public const ENGLISH_LANGUAGE_ID = 2;
  public const ENGLISH_LANGUAGE_CODE = 'en';

  /**
   * The current language ID.
   *
   * @var int
   */
  protected int $language = 0;

  /**
   * Translation constructor.
   */
  abstract protected function __construct();

  /**
   * Gets a translation.
   *
   * @param string $key
   *
   * @return string
   */
  abstract public static function get(string $key): string;

  /**
   * Loads all the translations.
   *
   * @return string[]
   */
  protected function loadTranslations(): array {
    if (self::DUTCH_LANGUAGE_ID === $this->language) {
      $filename = '/language/dutch/dutch_translations.php';

      return (array) include_file(RESOURCES_PATH . $filename);
    }

    if (self::ENGLISH_LANGUAGE_ID === $this->language) {
      $filename = '/language/english/english_translations.php';

      return (array) include_file(RESOURCES_PATH . $filename);
    }

    throw new NoTranslationsForGivenLanguageID(
          'No translations where found for the given language id: ' .
          $this->language
      );
  }

}
