<?php

declare(strict_types=1);


namespace Src\Action;

use Src\Security\CSRF;

/**
 * Provides a base class for form actions.
 *
 * @package Src\Action
 */
abstract class FormAction extends Action {

  /**
   * @inheritDoc
   */
  protected function authorize(): bool {
    if (!CSRF::validate()) {
      return FALSE;
    }

    return TRUE;
  }

}
