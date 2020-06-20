<?php

/**
 * @file
 */

declare(strict_types=1);

if (!function_exists('arrayToCsv')) {

  /**
   * Converts an array to csv.
   *
   * @param array[] $inputArray
   *   The array to convert.
   *
   * @return string
   */
  function arrayToCsv(array $inputArray) {
    $csvFieldRow = [];
    foreach ($inputArray as $csbRow) {
      $csvFieldRow[] = stringToCsv($csbRow);
    }

    return implode("\n", $csvFieldRow);
  }

}

if (!function_exists('stringToCsv')) {

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
   */
  function stringToCsv(
        array $input,
        string $delimiter = ',',
        string $enclosure = '"'
    ) {
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
if (!function_exists('outputCsv')) {

  /**
   * Takes in a filename and an array associative data array and outputs a csv file.
   *
   * @param string $fileName
   *   The filename.
   * @param array[] $assocDataArray
   *   The assoc data array.
   *
   * @return void
   */
  function outputCsv(string $fileName, array $assocDataArray) {
    ob_clean();
    header('Pragma: public');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Cache-Control: private', FALSE);
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment;filename=' . $fileName . '.csv');

    if (is_array($assocDataArray) && count($assocDataArray) > 0) {
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
