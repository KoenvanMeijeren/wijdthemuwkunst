<?php
declare(strict_types=1);

namespace Components\Translation;

use Components\SuperGlobals\Url\Uri;
use Components\Validate\Exceptions\Basic\InvalidKeyException;

/**
 * Provides a class for translations.
 *
 * @package src\Translation
 * @deprecated
 */
final class TranslationOld extends LoaderOld {

  /**
   * All the available translations.
   *
   * @var string[]
   */
  private static array $translations = [];

  /**
   * @inheritDoc
   */
  protected function __construct() {
    if (str_contains(Uri::getDomainExtension(), 'localhost')
          || str_contains(Uri::getDomainExtension(), 'nl')
      ) {
      $this->language = self::DUTCH_LANGUAGE_ID;
    }
    elseif (str_contains(Uri::getDomainExtension(), 'com')) {
      $this->language = self::ENGLISH_LANGUAGE_ID;
    }

    self::$translations = $this->loadTranslations();
  }

  /**
   * @inheritDoc
   */
  public static function get(string $key): string {
    new self();

    return self::$translations[$key] ?? throw new InvalidKeyException($key);
  }

}
