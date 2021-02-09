<?php


namespace System\Module;

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
   */
  public function getRoutesLocation(): string;

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
