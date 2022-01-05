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
   * Holds the class references.
   *
   * @var CSRF
   */
  protected static CSRF $instance;

  /**
   * CSRF constructor.
   *
   * @param \ParagonIE\AntiCSRF\AntiCSRF $csrf
   *   The CSRF definition.
   */
  protected function __construct(
    protected AntiCSRF $csrf = new AntiCSRF()
  ) {}

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
    $instance = self::getInstance();
    return $instance->csrf->insertToken($lockTo, self::ECHO_CSRF_TOKEN);
  }

  /**
   * {@inheritDoc}
   */
  public static function validate(): bool {
    $instance = self::getInstance();
    return $instance->csrf->validateRequest();
  }

}
