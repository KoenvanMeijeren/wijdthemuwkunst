<?php

declare(strict_types=1);


namespace Domain\Admin\Pages\Support;

use Src\Converter\ConverterBase;
use Src\Translation\Translation;

/**
 * Provides a class for converting the page is published state.
 *
 * @package Domain\Admin\Pages\Support
 */
final class PageIsPublishedStateConverterBase extends ConverterBase {

  /**
   * {@inheritDoc}
   */
  public function toReadable(): string {
    if ((bool) $this->var) {
      return Translation::get('admin_page_is_published');
    }

    return Translation::get('admin_page_is_not_published');
  }

}
