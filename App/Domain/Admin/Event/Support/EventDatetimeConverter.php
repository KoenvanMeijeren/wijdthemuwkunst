<?php

namespace Domain\Admin\Event\Support;

use Cake\Chronos\Chronos;
use Src\Converter\Converter;
use Src\Translation\Translation;
use Support\DateTime;

/**
 *
 */
final class EventDatetimeConverter extends Converter {

  /**
   *
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
