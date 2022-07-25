<?php
declare(strict_types=1);

namespace Modules\User;

use Modules\User\Controller\AccountController;
use Modules\User\Controller\UserAccountController;
use System\Module\Module;
use System\Module\ModuleBase;

/**
 * Defines the user module.
 *
 * @package Modules\User
 */
#[Module(
  name: 'Account',
  routes: [
    AccountController::class,
    UserAccountController::class,
  ]
)]
final class AccountModule extends ModuleBase {

}
