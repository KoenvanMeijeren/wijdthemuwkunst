<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\Repositories;

/**
 *
 */
final class AccountRepository {
  private int $id;
  private string $name;
  private string $email;
  private string $password;
  private int $rights;
  private string $logInToken;
  private int $failedLogInAttempts;
  private bool $isBlocked;
  private bool $isDeleted;

  /**
   * {@inheritDoc}
   */
  public function __construct(?object $account) {
    $this->id = (int) ($account->account_ID ?? '0');
    $this->name = $account->account_name ?? '';
    $this->email = $account->account_email ?? '';
    $this->password = $account->account_password ?? '';
    $this->rights = (int) ($account->account_rights ?? '0');
    $this->logInToken = ($account->account_login_token ?? '0');
    $this->failedLogInAttempts = (int) ($account->account_failed_login ?? '0');
    $this->isBlocked = (bool) ($account->account_is_blocked ?? '');
    $this->isDeleted = (bool) ($account->account_is_deleted ?? '');
  }

  /**
   * {@inheritDoc}
   */
  public function getId(): int {
    return $this->id;
  }

  /**
   * {@inheritDoc}
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * {@inheritDoc}
   */
  public function getEmail(): string {
    return $this->email;
  }

  /**
   * {@inheritDoc}
   */
  public function getPassword(): string {
    return $this->password;
  }

  /**
   * {@inheritDoc}
   */
  public function getRights(): int {
    return $this->rights;
  }

  /**
   * {@inheritDoc}
   */
  public function getLogInToken(): string {
    return $this->logInToken;
  }

  /**
   * {@inheritDoc}
   */
  public function getFailedLogInAttempts(): int {
    return $this->failedLogInAttempts;
  }

  /**
   * {@inheritDoc}
   */
  public function isBlocked(): bool {
    return $this->isBlocked;
  }

  /**
   * {@inheritDoc}
   */
  public function isDeleted(): bool {
    return $this->isDeleted;
  }

}
