<?php

declare(strict_types=1);

namespace System\Breadcrumbs;

use JetBrains\PhpStorm\Pure;

/**
 * Provides a class for generating breadcrumbs.
 *
 * @package System\Breadcrumbs
 */
final class Breadcrumbs extends BreadcrumbBase {

  /**
   * {@inheritDoc}
   */
  protected array $blacklist = [
    'concert',
    'setting',
    'text',
    'user',
    'item',
    'event',
    'page',
    'edit',
  ];

  /**
   * {@inheritDoc}
   */
  #[Pure] public function generate(): string {
    $breadcrumbs = '<nav>';
    $breadcrumbs .= '<ol class="breadcrumbs">';
    foreach ($this->breadCrumbs as $title => $url) {
      if ($title === 'admin') {
        $title = 'Home';
      }

      $breadcrumbs .= $this->buildLink($title, $url);
    }

    $breadcrumbs .= '</ol>';
    $breadcrumbs .= '</nav>';

    return $breadcrumbs;
  }

  /**
   * Builds the breadcrumb link.
   *
   * @param string $title
   *   The title.
   * @param string $url
   *   The url.
   *
   * @return string
   *   The link.
   */
  protected function buildLink(string $title, string $url): string {
    $title = ucfirst($title);

    return "<li><a href='{$url}'>{$title}</a></li>";
  }

}
