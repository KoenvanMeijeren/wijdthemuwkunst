<?php
declare(strict_types=1);

namespace Components\Datetime;

use IntlDateFormatter;

/**
 * Provides an interface for the data time object and interacting with timestamps.
 *
 * @package Support
 */
interface DateTimeInterface {

  /**
   * The default locale.
   *
   * @var string
   */
  public const DEFAULT_LOCALE = 'nl_NL';

  /**
   * The default timezone.
   *
   * @var string
   */
  public const DEFAULT_TIMEZONE = 'Europe/Amsterdam';

  /**
   * The default calendar.
   *
   * @var int
   */
  public const DEFAULT_CALENDAR = IntlDateFormatter::GREGORIAN;

  /**
   * Converts the datetime to a timestamp.
   *
   * @return int
   *   The timestamp.
   */
  public function toTimestamp(): int;

  /**
   * Converts the datetime to a number of a day.
   *
   * @return int
   *   The day number.
   */
  public function toDayNumber(): int;

  /**
   * Converts the datetime to a database date format.
   *
   * @return string
   *   The database date format.
   */
  public function toDatabaseFormat(): string;

  /**
   * Converts the datetime to a readable date format.
   *
   * @return string
   *   The readable date format.
   */
  public function toDateTime(): string;

  /**
   * Converts the datetime to a readable short date format.
   *
   * @return string
   *   The formatted date.
   */
  public function toFormattedDate(): string;

  /**
   * Converts the datetime to date.
   *
   * @return string
   *   The default date format.
   */
  public function toDate(): string;

  /**
   * Converts the datetime to time.
   *
   * @return string
   *   The default time format.
   */
  public function toTime(): string;

  /**
   * Converts the datetime to a short month notation of 3 chars.
   *
   * @return string
   *   The short month format.
   */
  public function toShortMonth(): string;

  /**
   * Converts the datetime to the specified format.
   *
   * @param string $format
   *   The format of the date.
   *
   * @return string
   *   The formatted date.
   */
  public function format(string $format = 'd-m-Y'): string;

}
