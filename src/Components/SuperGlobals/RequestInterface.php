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
   * @param \Components\SuperGlobals\ServerOptions $key
   *   The key to search for.
   * @param string $default
   *   The default value to return.
   *
   * @return string
   *   The session value.
   */
  public function server(ServerOptions $key, string $default = ''): string;

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
