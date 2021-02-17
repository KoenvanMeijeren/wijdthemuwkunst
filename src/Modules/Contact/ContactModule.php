<?php

namespace Modules\Contact;

use System\Module\ModuleBase;

/**
 * Defines the contact form module.
 *
 * @package Modules\Contact
 */
class ContactModule extends ModuleBase {

  /**
   * {@inheritDoc}
   */
  public function getName(): string {
    return 'Contact';
  }

}
