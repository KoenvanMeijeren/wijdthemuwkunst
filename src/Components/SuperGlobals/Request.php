<?php
declare(strict_types=1);

namespace Components\SuperGlobals;

use Components\Sanitize\Sanitize;
use Components\Route\Router;

/**
 * Provides a class for interacting with super globals.
 *
 * @package Components\SuperGlobals
 */
final class Request implements RequestInterface {

  /**
   * {@inheritDoc}
   */
  public function getHost(): string {
    $urlComponents = (array) parse_url($this->env('app_uri'));

    return $urlComponents['host'] ?? '';
  }

  /**
   * {@inheritDoc}
   */
  public function getRouteParameter(): string {
    return Router::getWildcard();
  }

  /**
   * {@inheritDoc}
   */
  public function server(string $key, string $default = ''): string {
    return $this->requestFromGlobal($_SERVER, $key, $default);
  }

  /**
   * {@inheritDoc}
   */
  public function post(string $key, $default = ''): string {
    return $this->requestFromGlobal($_POST, $key, $default);
  }

  /**
   * {@inheritDoc}
   */
  public function get(string $key, string $default = ''): string {
    return $this->requestFromGlobal($_GET, $key, $default);
  }

  /**
   * {@inheritDoc}
   */
  public function file(string $key): array {
    return $_FILES[$key] ?? [];
  }

  /**
   * {@inheritDoc}
   */
  public function env(string $key, string $default = ''): string {
    return $this->requestFromGlobal($_ENV, $key, $default);
  }

  /**
   * {@inheritDoc}
   */
  public function cookie(string $key, string $default = ''): string {
    return $this->requestFromGlobal($_COOKIE, $key, $default);
  }

  /**
   * {@inheritDoc}
   */
  public function session(string $key, string $default = ''): string {
    return $this->requestFromGlobal($_SESSION, $key, $default);
  }

  /**
   * Requests data from the super globals.
   *
   * @param array[] $superGlobal
   *   The specified super global.
   * @param string $key
   *   The key to search for.
   * @param string $default
   *   The default value to return.
   *
   * @return string
   *   The requested data from the super global
   *
   * @throws \JsonException
   */
  protected function requestFromGlobal(array $superGlobal, string $key, string $default = ''): string {
    if (!isset($superGlobal[$key])) {
      return $default;
    }

    if (is_array($superGlobal[$key])) {
      return json_encode($this->buildNewArray($superGlobal, $key), JSON_THROW_ON_ERROR);
    }

    return (new Sanitize((string) $superGlobal[$key]))->data();
  }

  /**
   * Builds a new array with sanitized values.
   *
   * @param array[] $superGlobal
   *   The specified super global.
   * @param string $key
   *   The key to search for.
   *
   * @return string[]
   *   The sanitized array.
   */
  protected function buildNewArray(array $superGlobal, string $key): array {
    $newArray = [];
    foreach ($superGlobal[$key] as $data) {
      if (is_scalar($data)) {
        $newArray[] = (new Sanitize($data))->data();
      }

      $newArray[] = $data;
    }

    return $newArray;
  }

}
