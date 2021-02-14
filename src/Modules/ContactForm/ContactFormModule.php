<?php

namespace Modules\ContactForm;

use System\Module\ModuleBase;

/**
 * Defines the contact form module.
 *
 * @package Modules\ContactForm
 */
class ContactFormModule extends ModuleBase {

  /**
   * {@inheritDoc}
   */
  public function getName(): string {
    return 'ContactForm';
  }

}
