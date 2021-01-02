<?php
declare(strict_types=1);

namespace Components\SuperGlobals;

/**
 * Provides an interface for interacting with super globals.
 *
 * @package Components\SuperGlobals
 */
interface RequestInterface {

  /**
   * A few server item options.
   *
   * @var string
   */
  public const URI = 'REQUEST_URI';
  // Used path info for page access.
  public const PATH_INFO = 'PATH_INFO';
  // Used method for page access.
  public const METHOD = 'REQUEST_METHOD';
  // Host header from current request.
  public const HTTP_HOST = 'HTTP_HOST';
  // Complete URL of current page.
  public const HTTP_REFERER = 'HTTP_REFERER';
  // The agent of the user.
  public const HTTP_USER_AGENT = 'HTTP_USER_AGENT';
  // IP address from the user his IP.
  public const USER_IP_ADDRESS = 'REMOTE_ADDR';
  // The root of the document.
  public const DOCUMENT_ROOT = 'DOCUMENT_ROOT';
  // The http origin of the request.
  public const HTTP_ORIGIN = 'HTTP_ORIGIN';
  // The server name of the request.
  public const SERVER_NAME = 'SERVER_NAME';

  /**
   * Gets the current host.
   *
   * @return string
   *   The host.
   */
  public function getHost(): string;

  /**
   * Gets the wildcard of the current route.
   *
   * @return string
   *   The route wildcard.
   */
  public function getRouteParameter(): string;

  /**
   * Gets a value from the session.
   *
   * @param string $key
   *   The key to search for.
   * @param string $default
   *   The default value to return.
   *
   * @return string
   *   The session value.
   */
  public function server(string $key, string $default = ''): string;

  /**
   * Gets a value from the post data.
   *
   * @param string $key
   *   The key to search for.
   * @param string $default
   *   The default value to return.
   *
   * @return string
   *   The post value.
   */
  public function post(string $key, $default = ''): string;

  /**
   * Gets a value from the get data.
   *
   * @param string $key
   *   The key to search for.
   * @param string $default
   *   The default value to return.
   *
   * @return string
   *   The get value.
   */
  public function get(string $key, string $default = ''): string;

  /**
   * Gets a uploaded file.
   *
   * @param string $key
   *   The key to search for.
   *
   * @return string[]
   *   The uploaded file.
   */
  public function file(string $key): array;

  /**
   * Gets a value from the env.
   *
   * @param string $key
   *   The key to search for.
   * @param string $default
   *   The default value to return.
   *
   * @return string
   *   The env value.
   */
  public function env(string $key, string $default = ''): string;

  /**
   * Gets a value from the cookies.
   *
   * @param string $key
   *   The key to search for.
   * @param string $default
   *   The default value to return.
   *
   * @return string
   *   The cookie value.
   */
  public function cookie(string $key, string $default = ''): string;

  /**
   * Gets a value from the session.
   *
   * @param string $key
   *   The key to search for.
   * @param string $default
   *   The default value to return.
   *
   * @return string
   *   The session value.
   */
  public function session(string $key, string $default = ''): string;

}
