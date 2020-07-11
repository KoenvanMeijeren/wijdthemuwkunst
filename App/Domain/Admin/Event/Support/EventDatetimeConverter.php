<?php

namespace Domain\Admin\Event\Support;

use Cake\Chronos\Chronos;
use Src\Converter\ConverterBase;
use Src\Translation\Translation;
use Support\DateTime;

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
    $readableDatetime .= Translation::get('at');
    $readableDatetime .= ' ';
    $readableDatetime .= $datetime->toTime();
    $readableDatetime .= ' ';
    $readableDatetime .= Translation::get('hour');

    return $readableDatetime;
  }

}
