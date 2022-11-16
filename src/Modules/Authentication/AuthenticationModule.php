<?php
declare(strict_types=1);

namespace Modules\Authentication;

use Modules\Authentication\Controllers\AuthenticationController;
use System\Module\Module;
use System\Module\ModuleBase;

/**
 * Defines the Authentication module.
 *
 * @package Modules\Authentication
 */
#[Module(
  name: 'Authentication',
  routes: [
    AuthenticationController::class,
  ]
)]
class AuthenticationModule extends ModuleBase {

}
