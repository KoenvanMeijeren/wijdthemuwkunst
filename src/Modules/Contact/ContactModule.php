<?php
declare(strict_types=1);

namespace Modules\Contact;

use Modules\Contact\Controller\AdminContactController;
use Modules\Contact\Controller\ContactController;
use System\Module\Module;
use System\Module\ModuleBase;

/**
 * Defines the contact form module.
 *
 * @package Modules\Contact
 */
#[Module(
  name: 'Contact',
  routes: [
    AdminContactController::class,
    ContactController::class,
  ]
)]
class ContactModule extends ModuleBase {

}
