<?php
declare(strict_types=1);

namespace Modules\User\Entity;

use Components\Route\RouteRights;
use System\Entity\EntityInterface;
use System\Entity\Status\EntityStatusInterface;

/**
 * Provides an interface for User entities.
 *
 * @package Modules\User\Entity
 */
interface AccountInterface extends EntityInterface, EntityStatusInterface {

  public const PASSWORD_HASH_METHOD = PASSWORD_ARGON2ID;

  /**
   * Sets the name of the account.
   */
  public function setName(string $name): AccountInterface;

  /**
   * Gets the name of the account.
   */
  public function getName(): ?string;

  /**
   * Sets the email of the account.
   */
  public function setEmail(string $email): AccountInterface;

  /**
   * Gets the email of the account.
   */
  public function getEmail(): ?string;

  /**
   * Sets the name of the account.
   */
  public function setPassword(string $password): AccountInterface;

  /**
   * Gets the name of the account.
   */
  public function getPassword(): ?string;

  /**
   * Sets the rights of the account.
   */
  public function setRights(int $rights): AccountInterface;

  /**
   * Gets the rights of the account.
   */
  public function getRights(): int;

  /**
   * Gets the rights of the account.
   */
  public function getRouteRights(): RouteRights;

  /**
   * Sets the login token of the account.
   */
  public function setLoginToken(?string $login_token): AccountInterface;

  /**
   * Gets the login token of the account.
   */
  public function getLoginToken(): ?string;

  /**
   * Sets the failed logins amount of the account.
   */
  public function setFailedLogins(int $amount): AccountInterface;

  /**
   * Gets the failed logins amount of the account.
   */
  public function getFailedLogins(): int;

  /**
   * Determines if the account is blocked.
   */
  public function setBlocked(): AccountInterface;

  /**
   * Determines if the account is blocked.
   */
  public function setActive(): AccountInterface;

  /**
   * Determines if the account is blocked.
   */
  public function isBlocked(): bool;

}
