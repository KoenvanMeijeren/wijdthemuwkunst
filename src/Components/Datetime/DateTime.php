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
    protected string $locale = self::DEFAULT_LOCALE,
    protected string $timezone = self::DEFAULT_TIMEZONE,
    protected int $calendar = self::DEFAULT_CALENDAR
  ) {}

  /**
   * {@inheritDoc}
   */
  public function toDatabaseFormat(): string {
    return $this->datetime->format('Y-m-d H:i:s');
  }

  /**
   * {@inheritDoc}
   */
  public function toTimestamp(): int {
    return $this->datetime->getTimestamp();
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
      $this->locale,
      IntlDateFormatter::FULL,
      IntlDateFormatter::SHORT
    );

    return $fmt->format(strtotime($this->datetime->toDateTimeString()));
  }

  /**
   * {@inheritDoc}
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
   * {@inheritDoc}
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
   * {@inheritDoc}
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
   * {@inheritDoc}
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
      replace: '',
      subject: $fmt->format(strtotime($this->datetime->toDateTimeString()))
    );
  }

  /**
   * {@inheritDoc}
   */
  public function format(string $format = 'd-m-Y'): string {
    return $this->datetime->format($format);
  }

}
