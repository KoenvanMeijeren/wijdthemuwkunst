<?php
declare(strict_types=1);

namespace Components\Translation;

use Components\Collection\CollectionStringBase;
use Modules\Text\TextModule;

/**
 * Provides a class for translating strings.
 *
 * @package Components\Translation
 */
class Translation extends CollectionStringBase implements TranslationInterface {

  /**
   * All the available translations.
   *
   * @var string[]
   */
  protected array $translations = [];

  public function __construct() {
    $textModule = new TextModule();

    $this->translations = $textModule->getTranslations();

    parent::__construct($this->translations);
  }

}
