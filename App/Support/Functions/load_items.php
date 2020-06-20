<?php

/**
 * @file
 */

declare(strict_types=1);

use Src\Validate\Validate;

if (!function_exists('includeFile')) {

  /**
   * Include safely a file and make it possible to access variables in the file.
   *
   * @param string $name
   *   The file to be included.
   * @param mixed|null $variables
   *   The variables to be extracted into the file.
   *
   * @return mixed
   */
  function includeFile(string $name, $variables = NULL) {
    if ($variables !== NULL) {
      extract($variables, EXTR_SKIP);
    }

    Validate::var($name)->fileExists();

    return include $name;
  }

}

if (!function_exists('getFileContents')) {

  /**
   * Get the content of a file.
   *
   * @param string $name
   *   The file to get the content from.
   *
   * @return string The content of the file.
   */
  function getFileContents(string $name) {
    Validate::var($name)->fileExists();

    return (string) file_get_contents($name);
  }

}

if (!function_exists('includeImage')) {

  /**
   * Load an image and return it.
   *
   * @param string $name
   *   the filename.
   * @param string $fallback
   *   the fallback for the filename.
   *
   * @return string the image or a fallback otherwise nothing
   */
  function includeImage(string $name, string $fallback) {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $name)) {
      return $name;
    }

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $fallback)) {
      return $fallback;
    }

    return '';
  }

}
