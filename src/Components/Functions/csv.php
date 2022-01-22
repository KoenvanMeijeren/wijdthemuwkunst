<?php

/**
 * @file
 * The csv functions.
 */

declare(strict_types=1);

if (!function_exists('array_to_csv')) {

  /**
   * Converts an array to csv.
   *
   * @param array[] $inputArray
   *   The array to convert.
   *
   * @return string
   *   The renderable csv.
   */
  function array_to_csv(array $inputArray): string {
    $csvFieldRow = [];
    foreach ($inputArray as $csbRow) {
      $csvFieldRow[] = string_to_csv($csbRow);
    }

    return implode("\n", $csvFieldRow);
  }

}

if (!function_exists('string_to_csv')) {

  /**
   * Converts a string to csv.
   *
   * @param array[] $input
   *   The input.
   * @param string $delimiter
   *   The delimiter.
   * @param string $enclosure
   *   The enclosure.
   *
   * @return string
   *   The string formatted as csv.
   */
  function string_to_csv(array $input, string $delimiter = ',', string $enclosure = '"'): string {
    // Open a memory "file" for read/write.
    $fp = fopen('php://temp', 'rb+');

    if (is_resource($fp)) {
      // Write the array to the target file using fputcsv()
      fputcsv($fp, $input, $delimiter, $enclosure);
      // Rewind the file.
      rewind($fp);
      // File Read.
      $data = fread($fp, 1048576);
      fclose($fp);
      // Ad line break and return the data.
      return rtrim((string) $data, "\n");
    }

    return '';
  }

}
if (!function_exists('output_csv')) {

  /**
   * Takes in a filename and an associative data array and outputs a csv file.
   *
   * @param string $fileName
   *   The filename.
   * @param array[] $assocDataArray
   *   The associative data array.
   */
  function output_csv(string $fileName, array $assocDataArray) {
    ob_clean();
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', FALSE);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=' . $fileName . '.csv');

    if (count($assocDataArray) > 0) {
      $fp = fopen('php://output', 'wb');

      if (is_resource($fp)) {
        foreach ($assocDataArray as $values) {
          fputcsv($fp, $values);
        }
        fclose($fp);
      }
    }
    ob_flush();
  }

}
