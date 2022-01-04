<?php
declare(strict_types=1);

namespace Components\Config;

use Components\Array\ArrayBase;
use Components\File\File;

/**
 * Provides a class for getting settings from the config.
 *
 * @package src\Config
 */
final class Config extends ArrayBase implements ConfigInterface {

  /**
   * ConfigLoader constructor.
   *
   * @param string $name
   *   The name of the config file.
   */
  public function __construct(
    protected readonly string $name
  ) {
    $file = new File(CONFIG_PATH, "{$this->name}.php");
    $config = $file->get();

    parent::__construct($config);
  }

}
