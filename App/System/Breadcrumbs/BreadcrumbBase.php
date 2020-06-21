<?php

namespace System\Breadcrumbs;

/**
 * Provides a base class for breadcrumbs.
 *
 * @package System\Breadcrumbs
 */
abstract class BreadcrumbBase implements BreadcrumbInterface {

  /**
   * The string to generate the breadcrumbs from.
   *
   * @var string
   */
  protected string $string;

  /**
   * The array with breadcrumbs.
   *
   * @var string[]
   */
  protected array $breadCrumbs = [];

  /**
   * A list with url parts which are forbidden to generate a breadcrumb from.
   *
   * @var string[]
   */
  protected array $blacklist = [];

  /**
   * BreadcrumbBase constructor.
   *
   * @param string $string
   *   The string to generate breadcrumbs from.
   * @param string $delimiter
   *   The boundary string.
   */
  public function __construct(string $string, string $delimiter = '/') {
    $this->breadCrumbs = $this->convertStringIntoBreadcrumbs($string, $delimiter);
  }

  /**
   * Convert the string parts into breadcrumbs.
   *
   * @param string $string
   *   The string to generate breadcrumbs from.
   * @param string $delimiter
   *   The boundary string.
   *
   * @return string[] The breadcrumbs.
   */
  protected function convertStringIntoBreadcrumbs(string $string, string $delimiter = '/'): array {
    $stringParts = (array) explode($delimiter, $string);

    $breadCrumbs = [];
    for ($x = 0, $xMax = count($stringParts); $x < $xMax; $x++) {
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
   * @inheritDoc
   */
  abstract public function generate(): string;

  /**
   * @inheritDoc
   */
  public function visible(int $minimum = 0): bool {
    return count($this->breadCrumbs) > $minimum;
  }

}
