<?php
declare(strict_types=1);

namespace Components\Actions;

use Src\Security\CSRF;
use Src\Validate\form\FormValidator;

/**
 * Provides a base class for form actions.
 *
 * @package Components\Actions
 */
abstract class FormAction extends Action {

  /**
   * The form validator.
   *
   * @var \Src\Validate\form\FormValidator
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
    return CSRF::validate();
  }

}
