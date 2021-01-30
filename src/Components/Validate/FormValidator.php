<?php
declare(strict_types=1);

namespace Components\Validate;

use Components\ComponentsTrait;
use DateTime;
use System\StateInterface;
use Components\Translation\TranslationOld;

/**
 * Provides a class for form validation actions.
 *
 * @package src\Validate
 */
final class FormValidator implements FormValidatorInterface {

  use ComponentsTrait;

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
   * {@inheritDoc}
   */
  public function input(string $inputName, string $alias = ''): FormValidatorInterface {
    $this->input = $this->request()->get($inputName, $inputName);
    $this->alias = $alias;

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isRequired(): FormValidatorInterface {
    if ($this->input === '') {
      $this->errors[] = sprintf(TranslationOld::get('validator_form_field_is_required'), $this->alias);
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function intIsRequired(): FormValidatorInterface {
    if ((int) $this->input === 0) {
      $this->errors[] = sprintf(TranslationOld::get('validator_form_field_is_required'), $this->alias);
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function settingIsRequired(): FormValidatorInterface {
    if ($this->input === '') {
      $this->errors[] = sprintf(TranslationOld::get('validator_admin_setting_required'), $this->alias);
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isInArray(string $value, array $allowedValues, string $errorMessage = ''): FormValidatorInterface {
    if (in_array($value, $allowedValues, strict: TRUE)) {
      return $this;
    }

    $error = $errorMessage;
    if ($errorMessage === '') {
      $error = sprintf(TranslationOld::get('validator_form_field_value_is_not_in_array'), $this->alias, $value);
    }

    $this->errors[] = $error;

    return $this;
  }


  /**
   * {@inheritDoc}
   */
  public function isBetweenRange(int $min, int $max, string $errorMessage = ''): FormValidatorInterface {
    $number = (int) $this->input;
    if ($number < $min || $number > $max) {
      $error = $errorMessage;
      if ($errorMessage === '') {
        $error = sprintf(
              TranslationOld::get('validator_form_field_has_invalid_range'),
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
   * {@inheritDoc}
   */
  public function isDateTime(): FormValidatorInterface {
    $dateTime = DateTime::createFromFormat('Y-m-d H:i:s', $this->input);
    $errors = DateTime::getLastErrors()['warning_count'] ?? 0;
    if ($dateTime === FALSE && $errors !== 0) {
      $this->errors[] = TranslationOld::get('validator_form_date_is_invalid');
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isEmail(): FormValidatorInterface {
    if (!(bool) filter_var($this->input, FILTER_VALIDATE_EMAIL)) {
      $this->errors[] = TranslationOld::get('validator_form_email_is_invalid');
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isUnique(?object $databaseRecord, string $errorMessage = ''): FormValidatorInterface {
    if ($databaseRecord !== NULL) {
      $error = $errorMessage;
      if ($errorMessage === '') {
        $error = sprintf(
              TranslationOld::get('validator_form_field_is_unique'),
              $this->alias
          );
      }

      $this->errors[] = $error;
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function passwordIsEqual(string $password): FormValidatorInterface {
    if ($this->input !== $password) {
      $this->errors[] = TranslationOld::get('validator_form_passwords_are_not_equal');
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function passwordIsNotCurrentPassword(string $currentHashedPassword): FormValidatorInterface {
    if (password_verify($this->input, $currentHashedPassword)) {
      $this->errors[] = TranslationOld::get(
            'validator_form_new_password_cannot_be_the_same_as_the_current_password'
        );
    }

    return $this;
  }

   /**
   * {@inheritDoc}
   */
  public function passwordIsVerified(string $hashedPassword): FormValidatorInterface {
    if (!password_verify($this->input, $hashedPassword)) {
      $this->errors[] = TranslationOld::get('validator_form_passwords_is_not_verified');
    }

    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getErrors(): array {
    return $this->errors;
  }

  /**
   * {@inheritDoc}
   */
  public function getErrorsAsString(): string {
    $error = TranslationOld::get('validator_form_base_error_message') . '<br><br>';

    foreach ($this->errors as $singleError) {
      $error .= '- ' . $singleError . '<br>';
    }

    return $error;
  }

  /**
   * {@inheritDoc}
   */
  public function flashErrorsIntoSession(): void {
    if (count($this->errors) === 0) {
      return;
    }

    $this->session()->flash(StateInterface::FORM_VALIDATION_FAILED, $this->getErrorsAsString());
  }

  /**
   * {@inheritDoc}
   */
  public function validate(): bool {
    return count($this->errors) === 0;
  }

  /**
   * {@inheritDoc}
   */
  public function handleFormValidation(): bool {
    $this->flashErrorsIntoSession();

    return $this->validate();
  }

}
