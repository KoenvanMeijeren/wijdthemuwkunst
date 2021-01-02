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

}
