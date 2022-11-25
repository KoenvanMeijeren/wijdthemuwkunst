<?php
declare(strict_types=1);

namespace Components\SuperGlobals;

use JetBrains\PhpStorm\Pure;

/**
 * Provides an enumeration for the server options.
 *
 * @package \Components\SuperGlobals
 */
enum ServerOptions: string {
  case URI = 'REQUEST_URI';
  // Used path info for page access.
  case PATH_INFO = 'PATH_INFO';
  // Used method for page access.
  case METHOD = 'REQUEST_METHOD';
  // Host header from current request.
  case HTTP_HOST = 'HTTP_HOST';
  // Complete URL of current page.
  case HTTP_REFERER = 'HTTP_REFERER';
  // The agent of the user.
  case HTTP_USER_AGENT = 'HTTP_USER_AGENT';
  // IP address from the user his IP.
  case USER_IP_ADDRESS = 'REMOTE_ADDR';
  // The root of the document.
  case DOCUMENT_ROOT = 'DOCUMENT_ROOT';
  // The http origin of the request.
  case HTTP_ORIGIN = 'HTTP_ORIGIN';
  // The server name of the request.
  case SERVER_NAME = 'SERVER_NAME';

  /**
   * Determines if the server option is equal or not.
   *
   * @param string $server_option
   *   The server option.
   *
   * @return bool
   *   Whether the server option is equal or not.
   */
  #[Pure]
  public function isEqualString(string $server_option): bool {
    return $this->value === $server_option;
  }

  /**
   * Determines if the server option is equal or not.
   *
   * @param \Components\SuperGlobals\ServerOptions $server_option
   *   The server option.
   *
   * @return bool
   *   Whether the server option is equal or not.
   */
  #[Pure]
  public function isEqual(ServerOptions $server_option): bool {
    return $this->isEqualString($server_option->value);
  }
}
