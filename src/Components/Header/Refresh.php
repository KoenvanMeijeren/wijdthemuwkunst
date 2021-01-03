<?php
declare(strict_types=1);

namespace Components\Header;

use Components\ComponentsTrait;

/**
 * Refreshes an user to a specified location.
 *
 * @package src\Core
 */
final class Refresh {

  use ComponentsTrait;

  /**
   * Refresh constructor.
   *
   * @param string $url
   *   The url to refresh.
   * @param int $refreshTime
   *   The time to wait before refreshing.
   */
  public function __construct(
    protected string $url,
    protected int $refreshTime
  ) {
    $this->header()->refresh($this->url, $this->refreshTime);
  }

}
