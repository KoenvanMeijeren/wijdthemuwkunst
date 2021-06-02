<?php
declare(strict_types=1);

namespace System\Module;

use Components\ComponentsTrait;
use Components\File\Exceptions\FileNotFoundException;
use Components\Validate\Validate;

/**
 * Provides a base class for modules.
 *
 * @package System\Module
 */
abstract class ModuleBase implements ModuleInterface {

  use ComponentsTrait;

  /**
   * {@inheritDoc}
   */
  public function getRoutesLocation(): ?string {
    try {
      $file_location = $this->getModuleLocation() . '/routes.php';

      Validate::var($file_location)->fileExists();

      return $file_location;
    } catch (FileNotFoundException $exception) {
      $this->log()->debug($exception->getMessage());
    }

    return null;
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
      $this->log()->error($exception->getMessage());
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
