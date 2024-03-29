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

  /**
   * The hash method of the account password.
   *
   * @var int
   */
  public const PASSWORD_HASH_METHOD = PASSWORD_ARGON2ID;

  /**
   * Sets the name of the account.
   *
   * @param string $name
   *   The name of the account.
   *
   * @return $this
   *   The called object reference.
   */
  public function setName(string $name): AccountInterface;

  /**
   * Gets the name of the account.
   *
   * @return string|null
   *   The name of the account.
   */
  public function getName(): ?string;

  /**
   * Sets the email of the account.
   *
   * @param string $email
   *   The email of the account.
   *
   * @return $this
   *   The called object reference.
   */
  public function setEmail(string $email): AccountInterface;

  /**
   * Gets the email of the account.
   *
   * @return string|null
   *   The email of the account.
   */
  public function getEmail(): ?string;

  /**
   * Sets the name of the account.
   *
   * @param string $password
   *   The name of the account.
   *
   * @return $this
   *   The called object reference.
   */
  public function setPassword(string $password): AccountInterface;

  /**
   * Gets the name of the account.
   *
   * @return string|null
   *   The name of the account.
   */
  public function getPassword(): ?string;

  /**
   * Sets the rights of the account.
   *
   * @param int $rights
   *   The rights of the account.
   *
   * @return $this
   *   The called object reference.
   */
  public function setRights(int $rights): AccountInterface;

  /**
   * Gets the rights of the account.
   *
   * @return int
   *   The rights of the account.
   */
  public function getRights(): int;

  /**
   * Gets the rights of the account.
   *
   * @return RouteRights
   *   The rights of the account.
   */
  public function getRouteRights(): RouteRights;

  /**
   * Sets the login token of the account.
   *
   * @param string $login_token
   *   The login token of the account.
   *
   * @return $this
   *   The called object reference.
   */
  public function setLoginToken(string $login_token): AccountInterface;

  /**
   * Gets the login token of the account.
   *
   * @return string|null
   *   The login token of the account.
   */
  public function getLoginToken(): ?string;

  /**
   * Sets the failed logins amount of the account.
   *
   * @param int $amount
   *   The failed logins amount of the account.
   *
   * @return $this
   *   The called object reference.
   */
  public function setFailedLogins(int $amount): AccountInterface;

  /**
   * Gets the failed logins amount of the account.
   *
   * @return int
   *   The failed logins amount of the account.
   */
  public function getFailedLogins(): int;

  /**
   * Determines if the account is blocked.
   *
   * @param bool $blocked
   *   If the account is blocked.
   *
   * @return $this
   *   The called object reference.
   */
  public function setBlocked(bool $blocked = TRUE): AccountInterface;

  /**
   * If the account is blocked.
   *
   * @return bool
   *   Whether the account is blocked or not.
   */
  public function isBlocked(): bool;

}
