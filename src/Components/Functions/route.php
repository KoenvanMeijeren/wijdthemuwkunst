<?php

/**
 * @file
 * The route functions.
 */

declare(strict_types=1);

if (!function_exists('urlFromRoute')) {

  /**
   * Tries to get an url from a route.
   *
   * @param string $route
   *   The route.
   *
   * @return string
   *   The url or a hashtag.
   */
  function urlFromRoute(string $route): string {
    return '#';
  }

}
