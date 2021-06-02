<?php

namespace System\Breadcrumbs;

/**
 * Provides an interface for breadcrumbs.
 *
 * @package System\Breadcrumbs
 */
interface BreadcrumbInterface {

  /**
   * The default minimum amount of breadcrumbs to be visible.
   *
   * @var int
   */
  public const BREADCRUMBS_MINIMUM_DEFAULT = 0;

  /**
   * Checks if the breadcrumbs are visible.
   *
   * @param int $minimum
   *   The minimum amount of breadcrumbs.
   *
   * @return bool
   *   If the breadcrumbs are visible.
   */
  public function visible(int $minimum = self::BREADCRUMBS_MINIMUM_DEFAULT): bool;

  /**
   * Generates the markup for the breadcrumbs.
   *
   * @return string
   *   The renderable breadcrumbs.
   */
  public function generate(): string;

}
