<?php

declare(strict_types=1);


namespace Support;

use Cake\Chronos\Chronos;
use IntlDateFormatter;

/**
 * Provides a wrapper for the data time object and interacting with timestamps.
 *
 * @package Support
 */
final class DateTime {

  /**
   * DateTime constructor.
   *
   * @param \Cake\Chronos\Chronos $datetime
   *   The datetime definition.
   * @param string $locale
   *   The locale timezone.
   * @param string $timezone
   *   Time zone ID, default is system default.
   * @param int $calendar
   *   Calendar to use for formatting or parsing; default is Gregorian.
   *   This is one of the IntlDateFormatter calendar constants.
   */
  public function __construct(
    protected Chronos $datetime,
    protected string $locale = 'nl_NL',
    protected string $timezone = 'Europe/Amsterdam',
    protected int $calendar = IntlDateFormatter::GREGORIAN
  ) {

  }

  /**
   * Convert the datetime to a number of a day.
   *
   * @return int
   *   The day number.
   */
  public function toDayNumber(): int {
    return $this->datetime->day;
  }

  /**
   * Convert the datetime to a readable date format.
   *
   * @return string
   *   The readable date format.
   */
  public function toDateTime(): string {
    $fmt = new IntlDateFormatter(
          $this->locale,
          IntlDateFormatter::FULL,
          IntlDateFormatter::SHORT
      );

    return $fmt->format(strtotime($this->datetime->toDateTimeString()));
  }

  /**
   * Convert the datetime to a readable short date format.
   *
   * @return string
   *   The formatted date.
   */
  public function toFormattedDate(): string {
    $fmt = new IntlDateFormatter(
          $this->locale,
          IntlDateFormatter::SHORT,
          IntlDateFormatter::NONE
      );

    return $fmt->format(strtotime($this->datetime->toDateTimeString()));
  }

  /**
   * Convert the datetime to date.
   *
   * @return string
   *   The default date format.
   */
  public function toDate(): string {
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
   *   The default time format.
   */
  public function toTime(): string {
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
   *   The short month format.
   */
  public function toShortMonth(): string {
    $fmt = new IntlDateFormatter(
          $this->locale,
          IntlDateFormatter::MEDIUM,
          IntlDateFormatter::NONE,
          $this->timezone,
          $this->calendar,
          'MMM'
      );

    return replace_dot(
          '',
          $fmt->format(strtotime($this->datetime->toDateTimeString()))
      );
  }

}
