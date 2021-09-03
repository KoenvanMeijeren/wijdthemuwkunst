<?php

namespace Modules\User;


use Modules\User\Entity\AccountInterface;

/**
 * Provides an interface for getting the current user.
 *
 * @package Modules\User
 */
interface CurrentUserInterface {

  /**
   * Gets the current user.
   *
   * @return \Modules\User\Entity\AccountInterface
   *   The current user.
   */
  public function get(): AccountInterface;

}
