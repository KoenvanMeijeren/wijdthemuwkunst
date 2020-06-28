<?php

/**
 * @file
 * The default functions.
 */

declare(strict_types=1);

if (!function_exists('array_replace_keys')) {

  /**
   * Replace the keys of an associate array by those supplied in the keys array.
   *
   * @param mixed[] $array
   *   Target associative array in which the keys are intended to be replaced.
   * @param mixed[] $keys
   *   Associate array where search key => replace by key, for replacing
   *   respective keys.
   *
   * @return mixed[]
   *   The array with replaced keys.
   */
  function array_replace_keys(array $array, array $keys) {
    foreach ($keys as $search => $replace) {
      if (array_key_exists($search, $array)) {
        $array[$replace] = $array[$search];
        unset($array[$search]);
      }
    }

    return $array;
  }

}

if (!function_exists('html_entities_decode')) {

  /**
   * Decode the data into HTML entities.
   *
   * @param string $data
   *   The data to be decoded.
   *
   * @return string
   *   The decoded html string.
   */
  function html_entities_decode(string $data) {
    return html_entity_decode(htmlspecialchars_decode($data));
  }

}

if (!function_exists('replace_string')) {

  /**
   * Replace all found string parts in a string.
   *
   * @param string $toRemove
   *   The string part to be replaced.
   * @param string $toReplace
   *   The new value of the string part which is going to be replaced.
   * @param string $string
   *   The string to replace parts from.
   * @param int $limit
   *   Limit the number of matches.
   *
   * @return string
   *   The updated string.
   */
  function replace_string(string $toRemove, string $toReplace, string $string, int $limit = -1) {
    return (string) preg_replace('/\b(' . $toRemove . ')\b/', $toReplace, $string, $limit);
  }

}

if (!function_exists('replace_dot')) {

  /**
   * Replace all found string parts in a string.
   *
   * @param string $toReplace
   *   The new value of the string part which is going to be replaced.
   * @param string $string
   *   The string to replace parts from.
   * @param int $limit
   *   Limit the number of matches.
   *
   * @return string
   *   The updated string.
   */
  function replace_dot(string $toReplace, string $string, int $limit = -1) {
    return (string) preg_replace('/\./', $toReplace, $string, $limit);
  }

}

if (!function_exists('replace_all_except_first_string')) {

  /**
   * Replace all found string parts in a string.
   *
   * @param string $toRemove
   *   The string part to be replaced.
   * @param string $toReplace
   *   The new value of the string part.
   * @param string $string
   *   The string to replace values from.
   *
   * @return string
   *   The updated string.
   */
  function replace_all_except_first_string(string $toRemove, string $toReplace, string $string) {
    return replace_string($toReplace, $toRemove, replace_string($toRemove, $toReplace, $string), 1);
  }

}

if (!function_exists('is_json')) {

  /**
   * Determine if the given data is of the type of json.
   *
   * @param string $data
   *   The data to be validated.
   *
   * @return bool
   *   If the string is JSON.
   */
  function is_json(string $data) {
    if ($data === '') {
      return FALSE;
    }

    try {
      json_decode($data, TRUE, 512, JSON_THROW_ON_ERROR);
    }
    catch (Exception $exception) {
      return FALSE;
    }

    return TRUE;
  }

}

if (!function_exists('random_string')) {

  /**
   * Generates securely a random string.
   *
   * Using a cryptographically secure pseudorandom number generator
   * (random_int).
   *
   * @param int $length
   *   How many characters do we want?
   * @param string $keyspace
   *   A string of all possible characters to select from.
   *
   * @return string
   *   The random string.
   */
  function random_string(int $length = 64, string $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'): string {
    if ($length < 1) {
      throw new RangeException('Length must be a positive integer');
    }

    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
      $pieces[] = $keyspace[random_int(0, $max)];
    }

    return implode('', $pieces);
  }

}

if (!function_exists('strip_whitespaces')) {

  /**
   * Remove al the whitespaces from the string.
   *
   * @param string $string
   *   The string to be stripped from whitespaces.
   *
   * @return string
   *   The string without unnecessary whitespaces.
   */
  function strip_whitespaces(string $string) {
    return trim($string);
  }

}

if (!function_exists('encode_url')) {

  /**
   * Encode a string into a url-save string.
   *
   * Test string: "Mess'd up --text-- just (to) stress /test/ ?our! `little`
   * \\clean\\ url fun.ction!?-->"
   *
   * @param string $string
   *   The unsafe string.
   * @param string[] $replace
   *   The replacement value that replaces found search values. An array may be
   *   used to designate multiple replacements.
   * @param string $delimiter
   *   The string or an array with strings to replace.
   *
   * @return string
   *   The string encoded to an url.
   */
  function encode_url(string $string, array $replace = [], string $delimiter = '-') {
    if (count($replace) > 1) {
      $string = str_replace($replace, ' ', $string);
    }

    $charset = (string) iconv('UTF-8', 'ASCII//TRANSLIT', $string);
    $clean = (string) preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $charset);
    $trimmedString = strtolower(trim($clean, '-'));
    $clean = (string) preg_replace("/[\/_|0-9+ -]+/", $delimiter, $trimmedString);

    return $clean;
  }

}

if (!function_exists('validate_date')) {

  /**
   * Check if the given date is a correct type.
   *
   * @param string $date
   *   The date to be checked.
   * @param string $format
   *   The format of the date.
   *
   * @return bool
   *   If the date is valid.
   */
  function validate_date($date, $format = 'Y-m-d') {
    $datetime = DateTime::createFromFormat($format, $date);
    if ($datetime !== FALSE) {
      return $datetime->format($format) === $date;
    }

    return FALSE;
  }

}

if (!function_exists('get_subclasses_of')) {

  /**
   * Gets all subclasses of the given parent.
   *
   * @param string $className
   *   The parent class.
   *
   * @return array
   *   The list with subclasses of the parent.
   */
  function get_subclasses_of(string $className) {
    $result = [];

    foreach (get_declared_classes() as $class) {
      if (is_subclass_of($class, $className)) {
        $result[] = $class;
      }
    }

    return $result;
  }

}
