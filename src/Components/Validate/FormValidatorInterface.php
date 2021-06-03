<?php
declare(strict_types=1);

namespace Components\Validate;

/**
 * Provides a class for form validation actions.
 *
 * @package src\Validate
 */
interface FormValidatorInterface {

  /**
   * Sets the input which is going to be validated.
   *
   * @param string $inputName
   *   The name of the input field.
   * @param string $alias
   *   The alias of the input.
   *
   * @return FormValidatorInterface
   *   The form validator object reference.
   */
  public function input(string $inputName, string $alias = ''): FormValidatorInterface;

  /**
   * Checks if the value is not empty.
   *
   * @return FormValidatorInterface
   *   The form validator object reference.
   */
  public function isRequired(): FormValidatorInterface;

  /**
   * Checks if the numeric value is not empty.
   *
   * @return FormValidatorInterface
   *   The form validator object reference.
   */
  public function intIsRequired(): FormValidatorInterface;

  /**
   * Checks if a specific setting value is not empty.
   *
   * @return FormValidatorInterface
   *   The form validator object reference.
   */
  public function settingIsRequired(): FormValidatorInterface;

  /**
   * Checks if the value is an allowed value.
   *
   * @param array $allowedValues
   *   The allowed values.
   * @param string $errorMessage
   *   The message to return if the value is invalid.
   *
   * @return FormValidatorInterface
   *   The form validator object reference.
   */
  public function isInArray(array $allowedValues, string $errorMessage = ''): FormValidatorInterface;

  /**
   * Verifies if the variable is between a given range.
   *
   * @param int $min
   *   The minimum range.
   * @param int $max
   *   The maximum range.
   * @param string $errorMessage
   *   The message to be shown if there is an error.
   *
   * @return FormValidatorInterface
   *   The called object reference.
   *
   * @throws Exceptions\Basic\InvalidKeyException
   */
  public function isBetweenRange(int $min, int $max, string $errorMessage = ''): FormValidatorInterface;

  /**
   * Validates if the variable is a valid date.
   *
   * @return FormValidatorInterface
   *   The called object reference.
   *
   * @throws Exceptions\Basic\InvalidKeyException
   */
  public function isDateTime(): FormValidatorInterface;

  /**
   * Validates if the variable is a valid email address.
   *
   * @return FormValidatorInterface
   *   The called object reference.
   *
   * @throws Exceptions\Basic\InvalidKeyException
   */
  public function isEmail(): FormValidatorInterface;

  /**
   * Validates if the variable is unique by searching in the database.
   *
   * @param object|null $databaseRecord
   *   The found database record.
   * @param string $errorMessage
   *   The error message.
   *
   * @return FormValidatorInterface
   *   The called object reference.
   */
  public function isUnique(?object $databaseRecord, string $errorMessage = ''): FormValidatorInterface;

  /**
   * Determines if the given password is equal to the input password.
   *
   * @param string $password
   *   The password.
   *
   * @return FormValidatorInterface
   *   The called object reference.
   *
   * @throws Exceptions\Basic\InvalidKeyException
   */
  public function passwordIsEqual(string $password): FormValidatorInterface;

  /**
   * Verifies the hashed password against the input password.
   *
   * @param string $currentHashedPassword
   *   The current hashed password.
   *
   * @return FormValidatorInterface
   *   The called object reference.
   *
   * @throws Exceptions\Basic\InvalidKeyException
   */
  public function passwordIsNotCurrentPassword(string $currentHashedPassword): FormValidatorInterface;

  /**
   * Verifies the hashed password against the input password.
   *
   * @param string $hashedPassword
   *   The hashed password.
   *
   * @return FormValidatorInterface
   *   The called object reference.
   * @throws Exceptions\Basic\InvalidKeyException
   */
  public function passwordIsVerified(string $hashedPassword): FormValidatorInterface;

  /**
   * Gets the current errors.
   *
   * @return string[]
   *   The errors.
   */
  public function getErrors(): array;

  /**
   * Renders the errors to a string.
   *
   * @return string
   *   The errors as a string.
   *
   * @throws Exceptions\Basic\InvalidKeyException
   */
  public function getErrorsAsString(): string;

  /**
   * Flashes the current errors into the session.
   *
   * On the first next request these errors will be shown to the user.
   */
  public function flashErrorsIntoSession(): void;

  /**
   * Determines whether the value was valid or not.
   *
   * @return bool
   *   Whether the value was valid or not.
   */
  public function validate(): bool;

  /**
   * Handles the form validation.
   *
   * @return bool
   *   Whether the value was valid or not.
   */
  public function handleFormValidation(): bool;

}
