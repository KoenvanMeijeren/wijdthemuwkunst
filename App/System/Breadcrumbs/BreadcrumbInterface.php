<?php

namespace App\System\Breadcrumbs;

/**
 * Provides an interface for breadcrumbs.
 *
 * @package App\System\Breadcrumbs
 */
interface BreadcrumbInterface {

  /**
   * Checks if the breadcrumbs are visible.
   *
   * @param int $minimum
   *   the minimum amount of breadcrumbs.
   *
   * @return bool
   */
  public function visible(int $minimum = 0): bool;

  /**
   * Generate the markup for the breadcrumbs.
   *
   * @return string
   */
  public function generate(): string;

}
