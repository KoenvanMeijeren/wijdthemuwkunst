<?php
declare(strict_types=1);

namespace Components\Translation;

use Components\Array\ArrayBase;
use Domain\Admin\Text\TextModule;

/**
 * Provides a class for translating strings.
 *
 * @package Components\Translation
 */
class Translation extends ArrayBase implements TranslationInterface {

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
