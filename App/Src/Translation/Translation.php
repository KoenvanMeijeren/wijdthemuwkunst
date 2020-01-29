<?php
declare(strict_types=1);


namespace Src\Translation;

use Src\Core\URI;
use Src\Exceptions\Basic\InvalidKeyException;

final class Translation extends Loader
{
    private static array $translations = [];

    protected function __construct()
    {
        if (strpos(URI::getDomainExtension(), 'localhost') !== false
            || strpos(URI::getDomainExtension(), 'nl') !== false
        ) {
            $this->language = self::DUTCH_LANGUAGE_ID;
        } elseif (strpos(URI::getDomainExtension(), 'com') !== false) {
            $this->language = self::ENGLISH_LANGUAGE_ID;
        }

        self::$translations = $this->loadTranslations();
    }

    public static function get(string $key): string
    {
        new self();

        if (array_key_exists($key, self::$translations)) {
            return self::$translations[$key];
        }

        throw new InvalidKeyException(
            "No translation was found with key: {$key}"
        );
    }
}
