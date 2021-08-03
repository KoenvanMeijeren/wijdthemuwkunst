<?php

/**
 * @file
 * The math functions.
 */

declare(strict_types=1);

if (!function_exists('sampling')) {

  /**
   * Samples the maximum possible combinations for the given chars and max size.
   *
   * Iterating over the combinations until we have received the number of
   * possible combinations.
   *
   * @param string[] $chars
   *   The chars to find the maximum possible combinations for.
   * @param int $size
   *   The maximum size of the combinations.
   * @param string[] $combinations
   *   The found combinations.
   *
   * @return string[]
   *   All the possible combinations.
   */
  function sampling(array $chars, int $size, array $combinations = []): array {
    if (count($combinations) < 1) {
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

if (!function_exists('sampling_with_only_one_used_char_per_string')) {

  /**
   * Samples the maximum possible combinations for the given chars and max size.
   *
   * Iterating over the combinations until we have received the number of
   * possible combinations.
   *
   * @param string[] $values
   *   The values.
   * @param int $size
   *   The maximum size of the combinations.
   *
   * @return string
   *   The sampled combinations.
   */
  function sampling_with_only_one_used_char_per_string(array $values, int $size): string {
    $generator = generate_combinations($values, $size);
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

if (!function_exists('generate_combinations')) {

  /**
   * Generate the combinations.
   *
   * Figure out how many combinations are possible and then we are iterating and
   * yielding the values.
   *
   * @param string[] $values
   *   The values.
   * @param int $count
   *   The maximum possible combinations.
   *
   * @return \Generator
   *   The generated combinations.
   */
  function generate_combinations(array $values, int $count = 0): Generator {
    $perm_count = count($values) ** $count;

    for ($i = 0; $i < $perm_count; $i++) {
      yield get_combination($values, $count, $i);
    }
  }

}

if (!function_exists('get_combination')) {

  /**
   * State based way of generating combinations.
   *
   * First we figure out where to start in the array and afterwards we append
   * it.
   *
   * @param string[] $values
   *   The values.
   * @param int $count
   *   The maximum possible combinations.
   * @param int $index
   *   Where to start in the array.
   *
   * @return string[]
   *   The combination.
   */
  function get_combination(array $values, int $count, int $index): array {
    $result = [];
    $values_count = count($values);
    for ($i = 0; $i < $count; $i++) {
      $pos = $index % $values_count;

      if (!in_array($values[$pos], $result, TRUE)) {
        $result[] = $values[$pos];
      }

      $index = ($index - $pos) / $values_count;
    }

    return $result;
  }

}
