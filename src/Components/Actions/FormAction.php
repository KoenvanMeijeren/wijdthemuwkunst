<?php
declare(strict_types=1);

namespace Components\Actions;

use Components\Security\CSRF;
use Components\Translation\TranslationOld;
use Components\Validate\FormValidator;
use System\State;

/**
 * Provides a base class for form actions.
 *
 * @package Components\Actions
 */
abstract class FormAction extends Action {

  /**
   * The form validator.
   *
   * @var \Components\Validate\FormValidator
   */
  protected FormValidator $validator;

  /**
   * FormAction constructor.
   */
  public function __construct() {
    $this->validator = new FormValidator();
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    $csrf_validation = CSRF::validate();
    if (!$csrf_validation) {
      $this->session()->flash(
        State::FAILED->value,
        TranslationOld::get('failed_csrf_check_message')
      );
    }

    return $csrf_validation;
  }

}
