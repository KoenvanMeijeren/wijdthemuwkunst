<?php
declare(strict_types=1);

namespace Components\SuperGlobals;

use Components\SuperGlobals\File\File;

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
   * Gets a value from the post data.
   *
   * @param string $key
   *   The key to search for.
   * @param string $default
   *   The default value to return.
   *
   * @return string
   *   The post value.
   *
   * @deprecated
   */
  public function post(string $key, $default = ''): string;

  /**
   * Gets the file collection.
   *
   * @return \Components\SuperGlobals\File\File
   *   The file collection.
   *
   * @deprecated
   */
  public function file(): File;

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
   *
   * @deprecated
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
   *
   * @deprecated
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
   *
   * @deprecated
   */
  public function session(string $key, string $default = ''): string;

}
