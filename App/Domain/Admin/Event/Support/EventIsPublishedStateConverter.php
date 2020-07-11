<?php

namespace Domain\Admin\Event\Support;

use Src\Converter\ConverterBase;
use Src\Translation\Translation;

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
      return Translation::get('admin_event_is_published');
    }

    return Translation::get('admin_event_is_not_published');
  }

}
