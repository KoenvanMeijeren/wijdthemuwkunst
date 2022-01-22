<?php
declare(strict_types=1);

namespace Modules\User\Entity;

use Components\Route\RouteRights;
use System\Entity\Status\EntityStatusBase;
use System\Entity\Type\ContentEntityType;

/**
 * Defines the User entity.
 *
 * @package Modules\User\Entity
 */
#[ContentEntityType(table: 'account')]
final class Account extends EntityStatusBase implements AccountInterface {

  /**
   * {@inheritDoc}
   */
  public function setName(string $name): AccountInterface {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getName(): ?string {
    return $this->get('name');
  }

  /**
   * {@inheritDoc}
   */
  public function setEmail(string $email): AccountInterface {
    $this->set('email', $email);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getEmail(): ?string {
    return $this->get('email');
  }

  /**
   * {@inheritDoc}
   */
  public function setPassword(string $password): AccountInterface {
    $this->set('password', password_hash($password, self::PASSWORD_HASH_METHOD));
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getPassword(): ?string {
    return $this->get('password');
  }

  /**
   * {@inheritDoc}
   */
  public function setRights(int $rights): AccountInterface {
    $this->set('rights', $rights);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getRights(): int {
    return (int) $this->get('rights');
  }

  /**
   * {@inheritDoc}
   */
  public function getRouteRights(): RouteRights {
    return RouteRights::set($this->getRights());
  }

  /**
   * {@inheritDoc}
   */
  public function setLoginToken(string $login_token): AccountInterface {
    $this->set('login_token', $login_token);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getLoginToken(): ?string {
    return $this->get('login_token');
  }

  /**
   * {@inheritDoc}
   */
  public function setFailedLogins(int $amount): AccountInterface {
    $this->set('failed_login', $amount);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function getFailedLogins(): int {
    return (int) $this->get('failed_login');
  }

  /**
   * {@inheritDoc}
   */
  public function setBlocked(bool $blocked = TRUE): AccountInterface {
    $this->set('is_blocked', (int) $blocked);
    return $this;
  }

  /**
   * {@inheritDoc}
   */
  public function isBlocked(): bool {
    return (bool) $this->get('is_blocked');
  }

}
