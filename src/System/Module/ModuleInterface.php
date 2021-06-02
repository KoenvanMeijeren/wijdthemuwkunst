<?php


namespace System\Module;

use Components\File\Exceptions\FileNotFoundException;

/**
 * Provides an interface for modules.
 *
 * @package System\Module
 */
interface ModuleInterface {

  /**
   * Gets the name of the module.
   *
   * @return string
   *   THe name of the module.
   */
  public function getName(): string;

  /**
   * Returns the location of the routes.
   *
   * @return string
   *   The routes file location.
   *
   * @throws FileNotFoundException|null
   *   When the file does not exists.
   */
  public function getRoutesLocation(): ?string;

  /**
   * Returns the location of the functions file.
   *
   * @return string
   *   The functions file location.
   */
  public function getFunctionsLocation(): string;

  /**
   * Returns the location of the translations.
   *
   * @return string
   *   The translations file location.
   */
  public function getTranslationsLocation(): string;

  /**
   * Returns the translations.
   *
   * @return array
   *   The translations.
   */
  public function getTranslations(): array;

}
