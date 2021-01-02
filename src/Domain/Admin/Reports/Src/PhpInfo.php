<?php

namespace Domain\Admin\Reports\Src;

/**
 *
 */
final class PhpInfo {

  /**
   *
   */
  public function get(): string {
    ob_start();

    phpinfo();

    $phpinfo = (string) ob_get_clean();

    return preg_replace(
          '%^.*<body>(.*)</body>.*$%ms',
          '$1',
          $phpinfo
      );
  }

}
