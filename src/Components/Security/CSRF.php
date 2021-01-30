<?php
declare(strict_types=1);

namespace Components\Security;

use ParagonIE\AntiCSRF\AntiCSRF;

/**
 * Provides a class for performing csrf validation.
 *
 * @package Components\Security
 */
final class CSRF implements CSRFInterface {

  /**
   * The CSRF definition.
   *
   * @var AntiCSRF
   */
  protected static AntiCSRF $csrf;

  /**
   * Holds the class references.
   *
   * @var CSRF
   */
  protected static CSRF $instance;

  /**
   * CSRF constructor.
   */
  protected function __construct() {
    self::$csrf = new AntiCSRF();
  }

  /**
   * {@inheritDoc}
   */
  public static function getInstance(): CSRF {
    return self::$instance ??= new self();
  }

  /**
   * {@inheritDoc}
   */
  public static function insertToken(string $lockTo): string {
    self::getInstance();
    return self::$csrf->insertToken($lockTo, self::ECHO_CSRF_TOKEN);
  }

  /**
   * {@inheritDoc}
   */
  public static function validate(): bool {
    self::getInstance();
    return self::$csrf->validateRequest();
  }

}
