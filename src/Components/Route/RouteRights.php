<?php

namespace Components\Route;

use JetBrains\PhpStorm\Pure;

/**
 * Provides an enumeration for the various route rights.
 *
 * @package \Components\Route
 */
enum RouteRights: int {
  case GUEST = 0;
  case ADMIN = 1;
  case SUPER_ADMIN = 2;
  case DEVELOPER = 3;

  /**
   * Sets the route rights.
   *
   * @param int $route_rights
   *   The route rights to search for.
   *
   * @return \Components\Route\RouteRights
   *   The route rights.
   *
   * @throws \Components\Route\InvalidRouteRightsException
   *   Occurs on invalid HTTP type given.
   */
  public static function set(int $route_rights): RouteRights {
    return match ($route_rights) {
      0 => self::GUEST,
      1 => self::ADMIN,
      2 => self::SUPER_ADMIN,
      3 => self::DEVELOPER,
      default => throw new InvalidRouteRightsException($route_rights)
    };
  }

  /**
   * Determines if the user has access.
   *
   * @param int $min_rights
   *   The minimum route rights to check access for.
   *
   * @return bool
   *   Whether the user has access or not.
   */
  public function hasAccessNumeric(int $min_rights): bool {
    return $this->value >= $min_rights;
  }

  /**
   * Determines if the user has access.
   *
   * @param \Components\Route\RouteRights $min_rights
   *   The minimum route rights to check access for.
   *
   * @return bool
   *   Whether the user has access or not.
   */
  #[Pure] public function hasAccess(RouteRights $min_rights): bool {
    return $this->hasAccessNumeric($min_rights->value);
  }

  /**
   * Determines if the user has access.
   *
   * @param int $min_rights
   *   The minimum route rights to check access for.
   *
   * @return bool
   *   Whether the user has access or not.
   */
  public function hasAccessForbiddenNumeric(int $min_rights): bool {
    return $this->value < $min_rights;
  }

  /**
   * Determines if the user has access.
   *
   * @param \Components\Route\RouteRights $min_rights
   *   The minimum route rights to check access for.
   *
   * @return bool
   *   Whether the user has access or not.
   */
  #[Pure] public function hasAccessForbidden(RouteRights $min_rights): bool {
    return $this->hasAccessForbiddenNumeric($min_rights->value);
  }

  /**
   * Determines if the user has access.
   *
   * @param int $min_rights
   *   The minimum route rights to check access for.
   *
   * @return bool
   *   Whether the user has access or not.
   */
  public function hasAccessHigherNumeric(int $min_rights): bool {
    return $this->value > $min_rights;
  }

  /**
   * Determines if the user has access.
   *
   * @param \Components\Route\RouteRights $min_rights
   *   The minimum route rights to check access for.
   *
   * @return bool
   *   Whether the user has access or not.
   */
  #[Pure] public function hasAccessHigher(RouteRights $min_rights): bool {
    return $this->hasAccessHigherNumeric($min_rights->value);
  }

}
