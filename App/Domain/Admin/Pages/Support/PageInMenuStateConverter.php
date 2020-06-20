<?php

declare(strict_types=1);


namespace Domain\Admin\Pages\Support;

use Domain\Admin\Pages\Models\Page;
use Src\Converter\Converter;
use Src\Translation\Translation;

/**
 *
 */
final class PageInMenuStateConverter extends Converter {

  /**
   *
   */
  public function toReadable(): string {
    $menuState = (int) $this->var;
    if ($menuState === Page::PAGE_NORMAL) {
      return Translation::get('page_normal');
    }

    if ($menuState === Page::PAGE_STATIC) {
      return Translation::get('page_static');
    }

    return Translation::get('page_in_menu_state_unknown');
  }

}
