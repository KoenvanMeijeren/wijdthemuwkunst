<?php
declare(strict_types=1);

namespace Components\Datetime;

use Cake\Chronos\Chronos;
use IntlDateFormatter;

/**
 * Provides a wrapper for the data time object and interacting with timestamps.
 *
 * @package Support
 */
final class DateTime implements DateTimeInterface {

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
   * {@inheritDoc}
   */
  public function toDayNumber(): int {
    return $this->datetime->day;
  }

  /**
   * {@inheritDoc}
   */
  public function toDateTime(): string {
    $fmt = new IntlDateFormatter(
      locale: $this->locale,
      datetype: IntlDateFormatter::FULL,
      timetype: IntlDateFormatter::SHORT
    );

    return $fmt->format(strtotime($this->datetime->toDateTimeString()));
  }

  /**
   * {@inheritDoc}
   */
  public function toFormattedDate(): string {
    $fmt = new IntlDateFormatter(
      locale: $this->locale,
      datetype: IntlDateFormatter::SHORT,
      timetype: IntlDateFormatter::NONE
    );

    return $fmt->format(strtotime($this->datetime->toDateTimeString()));
  }

  /**
   * {@inheritDoc}
   */
  public function toDate(): string {
    $fmt = new IntlDateFormatter(
      locale: $this->locale,
      datetype: IntlDateFormatter::FULL,
      timetype: IntlDateFormatter::NONE
    );

    return $fmt->format(strtotime($this->datetime->toDateTimeString()));
  }

  /**
   * {@inheritDoc}
   */
  public function toTime(): string {
    $fmt = new IntlDateFormatter(
      locale: $this->locale,
      datetype: IntlDateFormatter::NONE,
      timetype: IntlDateFormatter::SHORT
    );

    return $fmt->format(strtotime($this->datetime->toDateTimeString()));
  }

  /**
   * {@inheritDoc}
   */
  public function toShortMonth(): string {
    $fmt = new IntlDateFormatter(
      locale: $this->locale,
      datetype: IntlDateFormatter::MEDIUM,
      timetype: IntlDateFormatter::NONE,
      timezone: $this->timezone,
      calendar: $this->calendar,
      pattern: 'MMM'
    );

    return replace_dot(
      replace: '',
      subject: $fmt->format(strtotime($this->datetime->toDateTimeString()))
    );
  }

}
