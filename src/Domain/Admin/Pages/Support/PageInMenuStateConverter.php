<?php

declare(strict_types=1);


namespace Domain\Admin\Pages\Support;

use Components\Converter\ConverterBase;
use Components\Translation\TranslationOld;
use Domain\Admin\Pages\Models\Page;

/**
 * Provides a class for converting the page in menu value.
 *
 * @package Domain\Admin\Pages\Support
 */
final class PageInMenuStateConverter extends ConverterBase {

  /**
   * {@inheritDoc}
   */
  public function toReadable(): string {
    $menuState = (int) $this->var;
    if ($menuState === Page::PAGE_NORMAL) {
      return TranslationOld::get('page_normal');
    }

    if ($menuState === Page::PAGE_STATIC) {
      return TranslationOld::get('page_static');
    }

    return TranslationOld::get('page_in_menu_state_unknown');
  }

}
