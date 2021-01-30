<?php
declare(strict_types=1);

namespace Components\Security;

/**
 * Provides a class for interacting with the Google Recaptcha API.
 *
 * @package Components\Security
 */
interface RecaptchaInterface {

  /**
   * Validates the google recaptcha request.
   *
   * @return bool
   *   If the user is a robot or not.
   */
  public function validate(): bool;

}
