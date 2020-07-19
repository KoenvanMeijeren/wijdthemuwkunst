<?php

declare(strict_types=1);


namespace Src\Validate\form;

use DateTime;
use Src\Core\Request;
use Src\Core\StateInterface;
use Src\Session\Session;
use Src\Translation\Translation;

/**
 *
 */
final class FormValidator {

  /**
   * The input string to be validated.
   *
   * @var string
   */
  private string $input;

  /**
   * The alias of the input.
   *
   * @var string
   */
  private string $alias;

  /**
   * @var string[]
   */
  private array $errors = [];

  /**
   * The request definition.
   *
   * @var \Src\Core\Request
   */
  protected Request $request;

  /**
   *
   */
  public function __construct() {
    $this->request = new Request();
  }

  /**
   * Sets the input which is going to be validated.
   *
   * @param string $inputName
   *   The name of the input field.
   * @param string $alias
   *   The alias of the input.
   *
   * @return $this
   */
  public function input(string $inputName, string $alias = ''): FormValidator {
    $this->input = $this->request->get($inputName, $inputName);
    $this->alias = $alias;

    return $this;
  }

  /**
   *
   */
  public function isRequired(): FormValidator {
    if ($this->input === '') {
      $this->errors[] = sprintf(
            Translation::get('validator_form_field_is_required'),
            $this->alias
        );
    }

    return $this;
  }

  /**
   *
   */
  public function intIsRequired(): FormValidator {
    if ((int) $this->input === 0) {
      $this->errors[] = sprintf(
            Translation::get('validator_form_field_is_required'),
            $this->alias
        );
    }

    return $this;
  }

  /**
   *
   */
  public function settingIsRequired(): FormValidator {
    if ($this->input === '') {
      $this->errors[] = sprintf(
            Translation::get('validator_admin_setting_required'),
            $this->alias
        );
    }

    return $this;
  }

  /**
   * Checks if the value is an allowed value.
   *
   * @param string $value
   *   the value to be validated.
   * @param string[] $allowedValues
   *   the allowed values.
   * @param string $errorMessage
   *   the message to return if the value is
   *   invalid.
   *
   * @return $this
   */
  public function isInArray(
        string $value,
        array $allowedValues,
        string $errorMessage = ''
    ): FormValidator {
    if (!in_array($value, $allowedValues, TRUE)) {
      $error = $errorMessage;
      if ($errorMessage === '') {
        $error = sprintf(
              Translation::get('validator_form_field_value_is_not_in_array'),
              $this->alias,
              $value
          );
      }

      $this->errors[] = $error;
    }

    return $this;
  }

  /**
   *
   */
  public function isBetweenRange(
        int $min,
        int $max,
        string $errorMessage = ''
    ): FormValidator {
    $number = (int) $this->input;
    if ($number < $min || $number > $max) {
      $error = $errorMessage;
      if ($errorMessage === '') {
        $error = sprintf(
              Translation::get('validator_form_field_has_invalid_range'),
              $this->alias,
              $min,
              $max
          );
      }

      $this->errors[] = $error;
    }

    return $this;
  }

  /**
   *
   */
  public function isDateTime(): FormValidator {
    $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $this->input);
    $errors = DateTime::getLastErrors()['warning_count'] ?? 0;
    if ($dateTime === FALSE && $errors !== 0) {
      $this->errors[] = Translation::get('validator_form_date_is_invalid');
    }

    return $this;
  }

  /**
   *
   */
  public function isEmail(): FormValidator {
    if (!(bool) filter_var($this->input, FILTER_VALIDATE_EMAIL)) {
      $this->errors[] = Translation::get('validator_form_email_is_invalid');
    }

    return $this;
  }

  /**
   *
   */
  public function isUnique(
        ?object $databaseRecord,
        string $errorMessage = ''
    ): FormValidator {
    if ($databaseRecord !== NULL) {
      $error = $errorMessage;
      if ($errorMessage === '') {
        $error = sprintf(
              Translation::get('validator_form_field_is_unique'),
              $this->alias
          );
      }

      $this->errors[] = $error;
    }

    return $this;
  }

  /**
   *
   */
  public function passwordIsEqual(string $password): FormValidator {
    if ($this->input !== $password) {
      $this->errors[] = Translation::get('validator_form_passwords_are_not_equal');
    }

    return $this;
  }

  /**
   *
   */
  public function passwordIsNotCurrentPassword(
        string $currentHashedPassword
    ): FormValidator {
    if (password_verify($this->input, $currentHashedPassword)) {
      $this->errors[] = Translation::get(
            'validator_form_new_password_cannot_be_the_same_as_the_current_password'
        );
    }

    return $this;
  }

  /**
   *
   */
  public function passwordIsVerified(string $hashedPassword): FormValidator {
    if (!password_verify($this->input, $hashedPassword)) {
      $this->errors[] = Translation::get('validator_form_passwords_is_not_verified');
    }

    return $this;
  }

  /**
   * @return string[]
   */
  public function getErrors(): array {
    return $this->errors;
  }

  /**
   *
   */
  public function getErrorsAsString(): string {
    $error = Translation::get('validator_form_base_error_message') . '<br><br>';

    foreach ($this->errors as $singleError) {
      $error .= '- ' . $singleError . '<br>';
    }

    return $error;
  }

  /**
   *
   */
  public function flashErrorsIntoSession(): void {
    if (sizeof($this->errors) === 0) {
      return;
    }

    $session = new Session();
    $session->flash(
          StateInterface::FORM_VALIDATION_FAILED,
          $this->getErrorsAsString()
      );
  }

  /**
   *
   */
  public function validate(): bool {
    return sizeof($this->errors) === 0;
  }

  /**
   *
   */
  public function handleFormValidation(): bool {
    $this->flashErrorsIntoSession();

    return $this->validate();
  }

}
