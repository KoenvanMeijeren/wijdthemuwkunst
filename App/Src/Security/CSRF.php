<?php

declare(strict_types=1);

namespace Src\Security;

use ParagonIE\AntiCSRF\AntiCSRF;
use Src\Session\Session;
use Src\State\State;
use Src\Translation\Translation;

/**
 *
 */
final class CSRF {
  /**
   * Must the csrf token be shown?
   *
   * @var bool
   */
  public const ECHO_CSRF_TOKEN = FALSE;

  private static AntiCSRF $csrf;

  /**
   * Construct the csrf.
   */
  private function __construct() {
    self::$csrf = new AntiCSRF();
  }

  /**
   * Add the token to the form and lock it to an URL.
   *
   * @param string $lockTo
   *   the request is locked to the given URL.
   *
   * @return string
   *
   * @throws \Exception
   */
  public static function insertToken(string $lockTo): string {
    new CSRF();
    return self::$csrf->insertToken($lockTo, self::ECHO_CSRF_TOKEN);
  }

  /**
   * Check if the posted token is valid.
   *
   * @return bool
   *
   * @throws \Exception
   */
  public static function validate(): bool {
    $session = new Session();

    new CSRF();
    if (self::$csrf->validateRequest()) {
      return TRUE;
    }

    $session->flash(
          State::FAILED,
          Translation::get('failed_csrf_check_message')
      );
    return FALSE;
  }

}
