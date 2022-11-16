<?php

namespace Modules\Event\Utility;

use Cake\Chronos\Chronos;
use Components\Converter\ConverterBase;
use Components\Datetime\DateTime;
use Components\Translation\TranslationOld;

/**
 * Provides a class for converting event date times.
 *
 * @package Modules\Event\Utility
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
