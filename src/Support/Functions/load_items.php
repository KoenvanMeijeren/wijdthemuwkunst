<?php

/**
 * @file
 * The load items functions.
 */

declare(strict_types=1);

use Src\Validate\Validate;

if (!function_exists('include_file')) {

  /**
   * Include safely a file and make it possible to access variables in the file.
   *
   * @param string $name
   *   The file to be included.
   * @param mixed|null $variables
   *   The variables to be extracted into the file.
   *
   * @return mixed
   *   The included file.
   */
  function include_file(string $name, $variables = NULL) {
    if ($variables !== NULL) {
      extract($variables, EXTR_SKIP);
    }

    Validate::var($name)->fileExists();

    return include $name;
  }

}

if (!function_exists('get_file_contents')) {

  /**
   * Get the content of a file.
   *
   * @param string $name
   *   The file to get the content from.
   *
   * @return string
   *   The content of the file.
   */
  function get_file_contents(string $name) {
    Validate::var($name)->fileExists();

    return (string) file_get_contents($name);
  }

}

if (!function_exists('include_image')) {

  /**
   * Load an image and return it.
   *
   * @param string $name
   *   The name of the file.
   * @param string $fallback
   *   The name of the fallback file if the given filename does not exists.
   *
   * @return string
   *   The image or a fallback otherwise nothing
   */
  function include_image(string $name, string $fallback) {
    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $name)) {
      return $name;
    }

    if (file_exists($_SERVER['DOCUMENT_ROOT'] . $fallback)) {
      return $fallback;
    }

    return '';
  }

}
