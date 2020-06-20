<?php

namespace App\Domain\Admin\Event\Support;

use Src\Converter\Converter;
use Src\Translation\Translation;

/**
 *
 */
final class EventIsPublishedStateConverter extends Converter {

  /**
   *
   */
  public function toReadable(): string {
    if ((bool) $this->var) {
      return Translation::get('admin_event_is_published');
    }

    return Translation::get('admin_event_is_not_published');
  }

}
