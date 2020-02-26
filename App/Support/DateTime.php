<?php
declare(strict_types=1);


namespace Support;

use Cake\Chronos\Chronos;
use IntlDateFormatter;

final class DateTime
{
    private Chronos $datetime;

    private string $locale;
    private string $timezone;
    private int $calendar;

    public function __construct(
        Chronos $datetime,
        string $locale = 'nl_NL',
        string $timezone = 'Europe/Amsterdam',
        int $calendar = IntlDateFormatter::GREGORIAN
    ) {
        $this->datetime = $datetime;
        $this->locale = $locale;
        $this->timezone = $timezone;
        $this->calendar = $calendar;
    }

    public function toDayNumber(): int
    {
        return $this->datetime->day;
    }

    /**
     * Convert the datetime to datetime.
     *
     * @return string
     */
    public function toDateTime(): string
    {
        $fmt = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::FULL,
            IntlDateFormatter::SHORT
        );

        return $fmt->format(strtotime($this->datetime->toDateTimeString()));
    }

    /**
     * Convert the datetime to date.
     *
     * @return string
     */
    public function toDate(): string
    {
        $fmt = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::FULL,
            IntlDateFormatter::NONE
        );

        return $fmt->format(strtotime($this->datetime->toDateTimeString()));
    }

    /**
     * Convert the datetime to time.
     *
     * @return string
     */
    public function toTime(): string
    {
        $fmt = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::NONE,
            IntlDateFormatter::SHORT
        );

        return $fmt->format(strtotime($this->datetime->toDateTimeString()));
    }

    /**
     * Convert the datetime to a short month notation of 3 chars.
     *
     * @return string
     */
    public function toShortMonth(): string
    {
        $fmt = new IntlDateFormatter(
            $this->locale,
            IntlDateFormatter::MEDIUM,
            IntlDateFormatter::NONE,
            $this->timezone,
            $this->calendar,
            'MMM'
        );

        return replaceDot(
            '',
            $fmt->format(strtotime($this->datetime->toDateTimeString()))
        );
    }
}
