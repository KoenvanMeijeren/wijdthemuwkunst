<?php

declare(strict_types=1);


namespace Src\Translation;

use Src\Core\URI;
use Src\Exceptions\Basic\InvalidKeyException;

/**
 * Provides a class for translations.
 *
 * @package src\Translation
 */
final class Translation extends Loader {
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
    if (str_contains(URI::getDomainExtension(), 'localhost')
          || str_contains(URI::getDomainExtension(), 'nl')
      ) {
      $this->language = self::DUTCH_LANGUAGE_ID;
    }
    elseif (str_contains(URI::getDomainExtension(), 'com')) {
      $this->language = self::ENGLISH_LANGUAGE_ID;
    }

    self::$translations = $this->loadTranslations();
  }

  /**
   * @inheritDoc
   */
  public static function get(string $key): string {
    new self();

    if (array_key_exists($key, self::$translations)) {
      return self::$translations[$key];
    }

    throw new InvalidKeyException(
          "No translation was found with key: {$key}"
      );
  }

}
