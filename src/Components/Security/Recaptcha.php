<?php
declare(strict_types=1);

namespace Components\Security;

use Components\ComponentsTrait;
use Components\SuperGlobals\ServerOptions;
use Components\Translation\TranslationOld;
use ReCaptcha\ReCaptcha as GoogleRecaptcha;
use System\State;

/**
 * Provides a class for interacting with the Google Recaptcha API.
 *
 * @package Components\Security
 */
final class Recaptcha implements RecaptchaInterface {

  use ComponentsTrait;

  /**
   * The Google recaptcha definition.
   *
   * @var GoogleRecaptcha
   */
  protected readonly GoogleRecaptcha $recaptcha;

  /**
   * Recaptcha constructor.
   */
  public function __construct() {
    $this->recaptcha = new GoogleRecaptcha($this->request()->env('recaptcha_secret_key'));
  }

  /**
   * {@inheritDoc}
   */
  public function validate(): bool {
    $response = $this->recaptcha->verify(
      $this->request()->post('g-recaptcha-response'),
      $this->request()->server(ServerOptions::USER_IP_ADDRESS)
    );

    if ($response->isSuccess()) {
      return TRUE;
    }

    $this->session()->flash(
      State::FAILED->value,
      TranslationOld::get('failed_recaptcha_check_message')
    );

    return FALSE;
  }

}
