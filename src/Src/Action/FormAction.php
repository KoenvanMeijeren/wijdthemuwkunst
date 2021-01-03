<?php
declare(strict_types=1);

namespace Src\Action;

use System\Request;
use Src\Security\CSRF;
use Src\Session\Session;
use Src\Validate\form\FormValidator;

/**
 * Provides a base class for form actions.
 *
 * @package src\Action
 */
abstract class FormAction extends Action {

  /**
   * The request definition.
   *
   * @var \System\Request
   */
  protected Request $request;

  /**
   * The session definition.
   *
   * @var \Src\Session\Session
   */
  protected Session $session;

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
    $this->request = new Request();
    $this->session = new Session();
    $this->validator = new FormValidator();
  }

  /**
   * {@inheritDoc}
   */
  protected function authorize(): bool {
    return CSRF::validate();
  }

}
