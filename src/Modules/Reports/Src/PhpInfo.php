<?php
declare(strict_types=1);

namespace Modules\Reports\Src;

/**
 * Provides a class for getting data from the php installation.
 *
 * @package Modules\Reports\Src
 */
final class PhpInfo {

  /**
   * Gets data from the php installation.
   *
   * @return string
   *   The php installation info.
   */
  public function get(): string {
    ob_start();

    phpinfo();

    $phpinfo = (string) ob_get_clean();

    return preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $phpinfo);
  }

}
