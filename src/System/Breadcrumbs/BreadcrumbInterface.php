<?php

namespace System\Breadcrumbs;

/**
 * Provides an interface for breadcrumbs.
 *
 * @package System\Breadcrumbs
 */
interface BreadcrumbInterface {

  /**
   * Checks if the breadcrumbs are visible.
   *
   * @param int $minimum
   *   The minimum amount of breadcrumbs.
   *
   * @return bool
   *   If the breadcrumbs are visible.
   */
  public function visible(int $minimum = 0): bool;

  /**
   * Generates the markup for the breadcrumbs.
   *
   * @return string
   *   The renderable breadcrumbs.
   */
  public function generate(): string;

}
