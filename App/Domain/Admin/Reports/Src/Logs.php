<?php

namespace Domain\Admin\Reports\Src;

use Cake\Chronos\Chronos;
use Src\Log\Log;
use stdClass;
use Support\DateTime;

/**
 *
 */
final class Logs {

  /**
   *
   */
  public function get(string $date): array {
    $chronos = new Chronos($date);

    $logs = (array) preg_split(
          '/(?=\[\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}])/',
          Log::get($chronos->toDateString())
      );

    $firstKey = array_key_first($logs);
    unset($logs[$firstKey]);

    array_walk($logs, static function (&$value) {
      if (preg_match_all(
            '/\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}|(?<=]).*(?={)|{.*}/',
            $value,
            $matches,
            PREG_PATTERN_ORDER
        ) !== FALSE) {
            $matches = $matches[0] ?? [];
            $matches[2] = isJson($matches[2] ?? '') ? json_decode(
                $matches[2],
                FALSE,
                512,
                JSON_THROW_ON_ERROR
            ) : [];
      }

        $date = new DateTime(new Chronos($matches[0] ?? ''));
        $title = explode('on line', $matches[1] ?? '');
        $value = [
          'date' => ucfirst($date->toDateTime()),
          'title' => $title[0] ?? 'undefined',
          'message' => $matches[1] ?? 'undefined',
          'meta' => $matches[2] ?? new stdClass(),
        ];
    });

    return array_reverse($logs);
  }

}
