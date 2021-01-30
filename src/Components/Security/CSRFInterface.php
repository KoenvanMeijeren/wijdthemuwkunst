<?php
declare(strict_types=1);

namespace Components\Security;

/**
 * Provides an interface for subclasses for performing csrf validation.
 *
 * @package Components\Security
 */
interface CSRFInterface {

  /**
   * Must the csrf token be shown?
   *
   * @var bool
   */
  public const ECHO_CSRF_TOKEN = FALSE;

  /**
   * Gets the singleton instance of this class.
   *
   * @return CSRF
   *   The csrf definition.
   */
  public static function getInstance(): CSRF;

  /**
   * Adds the token to the form and lock it to an URL.
   *
   * @param string $lockTo
   *   The request is locked to this URL.
   *
   * @return string
   *   The CSRF token.
   */
  public static function insertToken(string $lockTo): string;

  /**
   * Check if the posted token is valid.
   *
   * @return bool
   *   Whether the request was valid or not.
   */
  public static function validate(): bool;

}
