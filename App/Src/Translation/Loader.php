<?php
declare(strict_types=1);


namespace App\Src\Translation;

use App\Src\Exceptions\Basic\NoTranslationsForGivenLanguageID;

abstract class Loader
{
    /**
     * The language options.
     *
     * @var int
     */
    public const DUTCH_LANGUAGE_ID = 1;
    public const DUTCH_LANGUAGE_CODE = 'nl';
    public const ENGLISH_LANGUAGE_ID = 2;
    public const ENGLISH_LANGUAGE_CODE = 'en';

    protected int $language = 0;

    abstract protected function __construct();

    abstract public static function get(string $key): string;

    final protected function loadTranslations(): array
    {
        if (self::DUTCH_LANGUAGE_ID === $this->language) {
            $filename = '/language/dutch/dutch_translations.php';

            return includeFile(RESOURCES_PATH . $filename);
        }

        if (self::ENGLISH_LANGUAGE_ID === $this->language) {
            $filename = '/language/english/english_translations.php';

            return includeFile(RESOURCES_PATH . $filename);
        }

        throw new NoTranslationsForGivenLanguageID(
            'No translations where found for the given language id: '.
            $this->language
        );
    }
}
