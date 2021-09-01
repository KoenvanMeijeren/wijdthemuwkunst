<?php

namespace Modules\User;

use System\Module\ModuleBase;

/**
 * Defines the user module.
 *
 * @package Modules\User
 */
class AccountModule extends ModuleBase {

  /**
   * {@inheritDoc}
   */
  public function getName(): string {
    return 'User';
  }

}
