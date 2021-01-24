<?php

namespace Domain\Admin\Event\Support;

use Cake\Chronos\Chronos;
use Components\Converter\ConverterBase;
use Components\Translation\TranslationOld;
use Components\Datetime\DateTime;

/**
 * Provides a class for converting event date times.
 *
 * @package Domain\Admin\Event\Support
 */
final class EventDatetimeConverter extends ConverterBase {

  /**
   * {@inheritDoc}
   */
  public function toReadable(): string {
    $datetime = new DateTime(new Chronos($this->var));

    $readableDatetime = $datetime->toDate();
    $readableDatetime .= ' ';
    $readableDatetime .= TranslationOld::get('at');
    $readableDatetime .= ' ';
    $readableDatetime .= $datetime->toTime();
    $readableDatetime .= ' ';
    $readableDatetime .= TranslationOld::get('hour');

    return $readableDatetime;
  }

}
