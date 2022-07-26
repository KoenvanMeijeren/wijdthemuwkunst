<?php

declare(strict_types=1);

namespace Components\Datetime;

/**
 * Provides a helper for date time objects.
 *
 * @package Components\Datetime
 */
final class DateTimeHelper
{

  /**
   * Determines if the input date is a valid date.
   */
  public static function isDate(string $input): bool {
    $arrayDate = explode('-', $input);
    $day = (int) ($arrayDate[0] ?? 0);
    $month = (int) ($arrayDate[1] ?? 0);
    $year = (int) ($arrayDate[2] ?? 0);

    return checkdate($month, $day, $year);
  }

}
