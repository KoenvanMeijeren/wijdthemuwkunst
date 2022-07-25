<?php
declare(strict_types=1);


namespace Components\SuperGlobals\File;

use Components\Collection\CollectionBase;

/**
 * Provides a class for File.
 *
 * @package Components\SuperGlobals\File;
 */
final class File extends CollectionBase {

  /**
   * File constructor.
   */
  public function __construct() {
    parent::__construct($_FILES);
  }

  /**
   * Gets the uploaded file.
   *
   * @param string $key
   *   The key.
   * @param mixed|NULL $default
   *   The default.
   *
   * @return string[]
   *   The uploaded file.
   */
  public function get(string $key, mixed $default = NULL): array {
    return (array) parent::get($key, $default);
  }

}
