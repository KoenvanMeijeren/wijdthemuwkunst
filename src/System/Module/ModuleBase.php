<?php
declare(strict_types=1);

namespace System\Module;

/**
 * Provides a base class for modules.
 *
 * @package System\Module
 */
abstract class ModuleBase implements ModuleInterface {

  /**
   * Returns the location of the routes.
   *
   * @return string
   *   The routes file location.
   */
  public function getRoutesLocation(): string {
    return $this->getModuleLocation() . '/routes.php';
  }

  /**
   * Returns the location of the translations.
   *
   * @return string
   *   The translations file location.
   */
  public function getTranslationsLocation(): string {
    return $this->getModuleLocation() . '/Translation';
  }

  /**
   * Gets the module location.
   *
   * @return string
   *   The location of the module.
   */
  protected function getModuleLocation(): string {
    $classReflector = new \ReflectionClass($this);
    $fileName = $classReflector->getFileName();

    $fileNameExploded = explode(separator: '/', string: $fileName);
    unset($fileNameExploded[array_key_last($fileNameExploded)]);

    return implode(separator: '/', array: $fileNameExploded);
  }

}
