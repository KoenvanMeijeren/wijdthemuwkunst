<?php
declare(strict_types=1);

namespace Modules\Reports\Src;

use Cake\Chronos\Chronos;
use Components\ComponentsTrait;
use Components\Datetime\DateTime;

/**
 * Provides a class for getting data from the logs.
 *
 * @package Modules\Reports\Src
 */
final class Logs {

  use ComponentsTrait;

  /**
   * Gets data from the log for a date.
   *
   * @param string $date
   *   The date.
   *
   * @return array
   *   The data from the log.
   *
   * @throws \JsonException
   */
  public function get(string $date): array {
    $chronos = new Chronos($date);

    $logs = (array) preg_split(
      '/(?=\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}])/',
      $this->logger()->getFile($chronos->toDateString())
    );

    $firstKey = array_key_first($logs);
    unset($logs[$firstKey]);

    array_walk($logs, static function (&$value) {
      if (preg_match_all('/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}|(?<=]).*(?={)|{.*}/',
        $value, $matches, PREG_PATTERN_ORDER) !== FALSE) {
          $matches = $matches[0] ?? [];
          if (is_json($matches[2] ?? '')) {
            $matches[2] = json_decode($matches[2] ?? '', true, 512, JSON_THROW_ON_ERROR);
          }
      }

      $date = new DateTime(new Chronos($matches[0] ?? ''));
      $title = explode('on line', $matches[1] ?? '');
      $value = [
        'date' => ucfirst($date->toDateTime()),
        'title' => $title[0] ?? 'undefined',
        'message' => $matches[1] ?? 'undefined',
        'meta' => $matches[2] ?? [],
      ];
    });

    return array_reverse($logs);
  }

}
