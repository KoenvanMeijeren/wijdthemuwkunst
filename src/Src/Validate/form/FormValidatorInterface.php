<?php
declare(strict_types=1);

namespace Src\Validate\form;

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
   * @param string $value
   *   The value to be validated.
   * @param string[] $allowedValues
   *   The allowed values.
   * @param string $errorMessage
   *   The message to return if the value is invalid.
   *
   * @return FormValidatorInterface
   *   The form validator object reference.
   */
  public function isInArray(string $value, array $allowedValues, string $errorMessage = ''): FormValidatorInterface;

}
