<?php

namespace Modules\Authentication;

use System\Module\ModuleBase;

/**
 * Defines the Authentication module.
 *
 * @package Modules\Authentication
 */
class AuthenticationModule extends ModuleBase {

  /**
   * {@inheritDoc}
   */
  public function getName(): string {
    return 'Authentication';
  }

}
