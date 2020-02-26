<?php


namespace App\Domain\Admin\Event\Support;

use Cake\Chronos\Chronos;
use Src\Converter\Converter;
use Support\DateTime;

final class EventDatetimeConverter extends Converter
{
    public function toReadable(): string
    {
        $datetime = new DateTime(new Chronos($this->var));

        $readableDatetime = $datetime->toDate();
        $readableDatetime .= ' om ';
        $readableDatetime .= $datetime->toTime();
        $readableDatetime .= ' uur';

        return $readableDatetime;
    }
}
