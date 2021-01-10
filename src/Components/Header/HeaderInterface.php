<?php
declare(strict_types=1);

namespace Components\Header;

/**
 * Provides an interface for interacting with the headers.
 *
 * @package Components\Header
 */
interface HeaderInterface {

  /**
   * Header options.
   *
   * @var string
   */
  public const X_XSS_PROTECTION = 'X-XSS-Protection: 1; mode=block;';

  /**
   * Sends a raw HTTP header.
   *
   * @param string $header
   *   The header string. <br>
   *   There are two special-case header calls. The first is a header that
   *   starts with the string "HTTP/" (case is not significant), which will be
   *   used to figure out the HTTP status code to send. For example, if you have
   *   configured Apache to use a PHP script to handle requests for missing
   *   files (using the ErrorDocument directive), you may want to make sure that
   *   your script generates the proper status code. The second special case is
   *   the "Location:" header. Not only does it send this header back to the
   *   browser, but it also returns a REDIRECT (302) status code to the browser
   *   unless the 201 or a 3xx status code has already been set.
   * @param bool $replace
   *   The optional replace parameter indicates whether the header should
   *   replace a previous similar header, or add a second header of the same
   *   type. By default it will replace, but if you pass in false as the second
   *   argument you can force multiple headers of the same type.
   *
   * @param int $response_code
   *   Forces the HTTP response code to the specified value.
   *
   * @link https://php.net/manual/en/function.header.php
   */
  public function send(string $header, bool $replace = TRUE, int $response_code = 0): void;

  /**
   * Redirects to a specific url.
   *
   * @param string $url
   *   The url to redirect to.
   */
  public function redirect(string $url): void;

  /**
   * Refreshes to a specified location.
   *
   * @param string $url
   *   The url to refresh.
   * @param int $refreshTime
   *   The time to wait before refreshing.
   */
  public function refresh(string $url, int $refreshTime): void;

  /**
   * Access denied, returns the HTTP 403 response.
   */
  public function accessDenied(): void;

  /**
   * Allows the given origin.
   *
   * @param string $origin
   *   The allowed origin.
   */
  public function allowOrigin(string $origin): void;

  /**
   * Removes previously send headers.
   *
   * @param string $name
   *   The header name to be removed.
   *   This parameter is case-insensitive.
   *
   * @link https://php.net/manual/en/function.header-remove.php
   */
  public function remove(string $name): void;

}
