<?php

namespace Components\Http;

/**
 * Provides an enumeration for HTTP types.
 *
 * @package \Components\SuperGlobals
 */
enum HttpTypes: string {

  case GET = 'GET';
  case POST = 'POST';

  /**
   * Sets the HTTP type.
   *
   * @param string $http_type
   *   The HTTP type to search for.
   *
   * @return \Components\Http\HttpTypes
   *   The HTTP type.
   *
   * @throws \Components\Http\InvalidHttpTypeException
   *   Occurs on invalid HTTP type given.
   */
  public static function set(string $http_type): HttpTypes {
    return match (strtoupper($http_type)) {
      self::GET->value => self::GET,
      self::POST->value => self::POST,
      default => throw new InvalidHttpTypeException($http_type)
    };
  }

}
