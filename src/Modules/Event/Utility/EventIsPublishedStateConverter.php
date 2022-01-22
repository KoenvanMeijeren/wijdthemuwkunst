<?php

namespace Modules\Event\Utility;

use Components\Converter\ConverterBase;
use Components\Translation\TranslationOld;

/**
 * Provides a class for converting the published state of an event.
 *
 * @package Modules\Event\Utility
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
