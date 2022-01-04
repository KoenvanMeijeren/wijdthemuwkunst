<?php
declare(strict_types=1);

namespace Modules\Page\Entity;

use JetBrains\PhpStorm\Pure;

/**
 * Provides an enumeration for page visibility options.
 *
 * @package \Modules\Page\Entity
 */
enum PageVisibility: int {
  case PAGE_NORMAL = 1;
  case PAGE_STATIC = 2;

  /**
   * Sets the page visibility.
   *
   * @param int $visibility
   *   The visibility.
   *
   * @return \Modules\Page\Entity\PageVisibility
   *   The page visibility.
   *
   * @throws \Modules\Page\Entity\InvalidPageVisibilityException
   */
  public static function set(int $visibility): PageVisibility {
    return match ($visibility) {
      self::PAGE_NORMAL->value => self::PAGE_NORMAL,
      self::PAGE_STATIC->value => self::PAGE_STATIC,
      default => throw new InvalidPageVisibilityException($visibility),
    };
  }

  /**
   * Determines if the page visibility is equal or not.
   *
   * @param int $visibility
   *   The visibility.
   *
   * @return bool
   *   Whether the page visibility is equal or not.
   */
  #[Pure]
  public function isEqualNumeric(int $visibility): bool {
    return $this->value === $visibility;
  }

  /**
   * Determines if the page visibility is equal or not.
   *
   * @param \Modules\Page\Entity\PageVisibility $visibility
   *   The visibility.
   *
   * @return bool
   *   Whether the page visibility is equal or not.
   */
  #[Pure]
  public function isEqual(PageVisibility $visibility): bool {
    return $this->isEqualNumeric($visibility->value);
  }
}
