<?php

/**
 * @file
 * Autoload the functions.
 */

declare(strict_types=1);

use Components\File\Exceptions\FileNotFoundException;
use Components\Validate\Validate;
use System\Module\ModuleHandler;

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

$moduleHandler = new ModuleHandler();
$modules = $moduleHandler->getModules();
foreach ($modules as $module) {
  try {
    $functionFile = $module->getFunctionsLocation();
    Validate::var($functionFile)->fileExists()->isReadable();

    include_once $functionFile;
  } catch (FileNotFoundException $exception) {
    continue;
  }
}

