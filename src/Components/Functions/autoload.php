<?php

/**
 * @file
 * Autoload the functions.
 */

declare(strict_types=1);

use Src\Validate\Validate;

$filenames = [
  'default',
  'csv',
  'components',
  'math',
  'load_items',
];

foreach ($filenames as $filename) {
  $filename = APP_PATH . '/Components/Functions/' . $filename . '.php';

  Validate::var($filename)->fileExists();

  include_once $filename;
}
