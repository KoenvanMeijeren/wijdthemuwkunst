<?php

declare(strict_types=1);


namespace System;

/**
 * @deprecated
 */
final class Request {
  /**
   * A few server item options.
   *
   * @var string
   */
  // Used URI for page access.
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
   *
   */
  public function getHost(): string {
    $urlComponents = (array) parse_url($this->env('app_uri'));

    return $urlComponents['host'] ?? '';
  }

  /**
   * Returns the parameter of the route.
   *
   * @return string
   *   The route parameter.
   */
  public function getRouteParameter(): string {
    return Router::getWildcard();
  }

  /**
   * Get a server item.
   *
   * @param string $key
   *   the key to search for the corresponding
   *   value in the server array.
   * @param string $default
   *   the default value to return.
   *
   * @return string
   */
  public function server(string $key, string $default = ''): string {
    return $this->requestFromGlobal($_SERVER, $key, $default);
  }

  /**
   * Get a post item.
   *
   * @param string $key
   *   the key to search for the corresponding
   *   value in the post array.
   * @param mixed $default
   *   the default value to return.
   *
   * @return string
   */
  public function post(string $key, $default = ''): string {
    return $this->requestFromGlobal($_POST, $key, $default);
  }

  /**
   * Get a get item.
   *
   * @param string $key
   *   the key to search for the corresponding
   *   value in the get array.
   * @param string $default
   *   the default value to return.
   *
   * @return string
   */
  public function get(string $key, string $default = ''): string {
    return $this->requestFromGlobal($_GET, $key, $default);
  }

  /**
   * Get a uploaded file.
   *
   * @param string $key
   *   the key to search for the
   *   corresponding value in
   *                    the file array.
   *
   * @return string[]
   */
  public function file(string $key): array {
    return array_key_exists($key, $_FILES) ? $_FILES[$key] : [];
  }

  /**
   * Get an env item.
   *
   * @param string $key
   *   the key to search for the corresponding
   *   value in the env array.
   * @param string $default
   *   the default value to return.
   *
   * @return string
   */
  public function env(string $key, string $default = ''): string {
    return $this->requestFromGlobal($_ENV, $key, $default);
  }

  /**
   * Get a cookie item.
   *
   * @param string $key
   *   the key to search for the corresponding
   *   value in the cookie array.
   * @param string $default
   *   the default value to return.
   *
   * @return string
   */
  public function cookie(string $key, string $default = ''): string {
    return $this->requestFromGlobal($_COOKIE, $key, $default);
  }

  /**
   * Get a session item.
   *
   * @param string $key
   *   the key to search for the corresponding
   *   value in the session array.
   * @param string $default
   *   the default value to return.
   *
   * @return string
   */
  public function session(string $key, string $default = ''): string {
    return $this->requestFromGlobal($_SESSION, $key, $default);
  }

  /**
   * Request data from the super globals.
   *
   * @param array[] $superGlobal
   *   get the data from the super global.
   * @param string $key
   *   the key to search for the corresponding
   *   value in the super global.
   * @param string $default
   *   the default value to return.
   *
   * @return string the data from the super global
   */
  private function requestFromGlobal(
        array $superGlobal,
        string $key,
        string $default = ''
    ): string {
    if (!array_key_exists($key, $superGlobal)) {
      return $default;
    }

    if (is_array($superGlobal[$key])) {
      return json_encode(
            $this->buildNewArray($superGlobal, $key),
            JSON_THROW_ON_ERROR
        );
    }

    return (string) (new \Components\Sanitize\Sanitize($superGlobal[$key]))->data();
  }

  /**
   * Build a new array with sanitized values.
   *
   * @param array[] $superGlobal
   *   get the data from the super global.
   * @param string $key
   *   the key to search for the corresponding
   *   value in the super global.
   *
   * @return string[]|int[]|bool[]|float[]
   */
  private function buildNewArray(array $superGlobal, string $key): array {
    $newArray = [];
    foreach ($superGlobal[$key] as $data) {
      if (is_scalar($data)) {
        $newArray[] = (new \Components\Sanitize\Sanitize($data))->data();
      }

      $newArray[] = $data;
    }

    return $newArray;
  }

}
