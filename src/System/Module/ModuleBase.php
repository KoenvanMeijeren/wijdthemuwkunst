<?php
declare(strict_types=1);

namespace System\Module;

use Components\File\Exceptions\FileNotFoundException;

/**
 * Provides a base class for modules.
 *
 * @package System\Module
 */
abstract class ModuleBase implements ModuleInterface {

  /**
   * {@inheritDoc}
   */
  public function getRoutesLocation(): string {
    return $this->getModuleLocation() . '/routes.php';
  }

  /**
   * {@inheritDoc}
   */
  public function getFunctionsLocation(): string {
    return $this->getModuleLocation() . '/functions.php';
  }

  /**
   * {@inheritDoc}
   */
  public function getTranslationsLocation(): string {
    return $this->getModuleLocation() . '/Translation';
  }

  /**
   * {@inheritDoc}
   */
  public function getTranslations(): array {
    try {
      return (array) include_file($this->getModuleLocation() . '/Translation');
    } catch (FileNotFoundException $exception) {
      return [];
    }
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
