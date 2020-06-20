<?php

/**
 * @file
 */

declare(strict_types=1);

if (!function_exists('sampling')) {

  /**
   * Iterating over the combinations until we have received the number of
   * possible combinations.
   *
   * @param string[] $chars
   * @param int $size
   * @param string[] $combinations
   *
   * @return string[] all the possible combinations
   */
  function sampling(array $chars, int $size, array $combinations = []) {
    if (sizeof($combinations) < 1) {
      $combinations = $chars;
    }

    if ($size === 1) {
      return $combinations;
    }

    $newCombinations = [];
    foreach ($combinations as $combination) {
      foreach ($chars as $char) {
        $newCombinations[] = $combination . $char;
      }
    }

    return sampling($chars, $size - 1, $newCombinations);
  }

}

if (!function_exists('samplingWithOnlyOneUsedCharPerString')) {

  /**
   * Iterating over the combinations until we have received the number of
   * possible combinations.
   *
   * @param string[] $values
   * @param int $size
   *
   * @return string
   */
  function samplingWithOnlyOneUsedCharPerString(array $values, int $size) {
    $generator = generateCombinations($values, $size);
    $string = '';

    foreach ($generator as $value) {
      if (count($value) !== 6) {
        continue;
      }

      foreach ($value as $item) {
        $string .= $item . ' ';
      }

      $string .= '<br>';
    }

    return $string;
  }

}

if (!function_exists('generateCombinations')) {

  /**
   * Generate the combinations.
   * Figure out how many combinations are possible.
   * Then we are iterating and yielding the values.
   *
   * @param string[] $values
   * @param int $count
   *
   * @return Generator|mixed
   */
  function generateCombinations(array $values, int $count = 0) {
    $permCount = count($values) ** $count;

    for ($i = 0; $i < $permCount; $i++) {
      yield getCombination($values, $count, $i);
    }
  }

}

if (!function_exists('getCombination')) {

  /**
   * State based way of generating combinations.
   *
   * First we figure out where to start in the array.
   * And afterwards we append it.
   *
   * @param string[] $values
   * @param int $count
   * @param int $index
   *
   * @return string[]
   */
  function getCombination(array $values, int $count, int $index) {
    $result = [];
    for ($i = 0; $i < $count; $i++) {
      $pos = $index % count($values);

      if (!in_array($values[$pos], $result, TRUE)) {
        $result[] = $values[$pos];
      }

      $index = ($index - $pos) / count($values);
    }

    return $result;
  }

}
