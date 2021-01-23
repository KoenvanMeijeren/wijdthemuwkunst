<?php

namespace Domain\Admin\Event\Support;

use Components\Converter\ConverterBase;
use Components\Translation\TranslationOld;

/**
 * Provides a class for converting the published state of an event.
 *
 * @package Domain\Admin\Event\Support
 */
final class EventIsPublishedStateConverter extends ConverterBase {

  /**
   * {@inheritDoc}
   */
  public function toReadable(): string {
    if ((bool) $this->var) {
      return TranslationOld::get('admin_event_is_published');
    }

    return TranslationOld::get('admin_event_is_not_published');
  }

}
