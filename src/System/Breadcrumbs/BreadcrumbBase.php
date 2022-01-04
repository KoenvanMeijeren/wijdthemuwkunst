<?php

namespace System\Breadcrumbs;

/**
 * Provides a base class for breadcrumbs.
 *
 * @package System\Breadcrumbs
 */
abstract class BreadcrumbBase implements BreadcrumbInterface {

  /**
   * BreadcrumbBase constructor.
   *
   * @param string $string
   *   The string to generate breadcrumbs from.
   * @param string $delimiter
   *   The boundary string.
   * @param string[] $blacklist
   *   A list with url parts which are forbidden to generate a breadcrumb from.
   * @param string[] $breadCrumbs
   *   The array with breadcrumbs.
   */
  public function __construct(
    protected readonly string $string,
    string $delimiter = '/',
    protected array $blacklist = [],
    protected array $breadCrumbs = []
  ) {
    $this->breadCrumbs = $this->stringToBreadcrumbs($string, $delimiter);
  }

  /**
   * Convert the string parts into breadcrumbs.
   *
   * @param string $string
   *   The string to generate breadcrumbs from.
   * @param string $delimiter
   *   The boundary string.
   *
   * @return string[]
   *   The breadcrumbs.
   */
  protected function stringToBreadcrumbs(string $string, string $delimiter = '/'): array {
    $stringParts = explode($delimiter, $string);

    $breadCrumbs = [];
    foreach ($stringParts as $stringPart) {
      $lastStringPart = array_key_last($stringParts);

      $title = $stringParts[$lastStringPart];
      $url = $delimiter . implode($delimiter, $stringParts);

      if (!in_array($title, $this->blacklist, TRUE)) {
        $breadCrumbs[$title] = $url;
      }

      // Remove the last string part from the string parts in order to be
      // able to get the title for the next breadcrumb.
      unset($stringParts[$lastStringPart]);
    }

    return array_reverse($breadCrumbs, TRUE);
  }

  /**
   * {@inheritDoc}
   */
  final public function visible(int $minimum = self::BREADCRUMBS_MINIMUM_DEFAULT): bool {
    return count($this->breadCrumbs) > $minimum;
  }

}
