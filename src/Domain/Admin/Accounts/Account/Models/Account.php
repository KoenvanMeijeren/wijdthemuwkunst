<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Models;

use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;
use stdClass;

/**
 * Provides a model for the account table to interact with the database.
 *
 *@package Domain\Admin\Accounts\Account\Models
 */
final class Account extends Model {
  use SoftDelete;

  protected string $table = 'account';
  protected string $primaryKey = 'account_ID';
  protected string $softDeletedKey = 'account_is_deleted';

  /**
   * The hash method of the account password.
   *
   * @var int
   */
  public const PASSWORD_HASH_METHOD = PASSWORD_ARGON2ID;

  /**
   * Account constructor.
   */
  public function __construct() {
    $this->initializeSoftDelete();
  }

  /**
   * Get an account by the given email.
   *
   * @param string $email
   *   The email to search to account for.
   *
   * @return object|null
   *   The account if found.
   */
  public function getByEmail(string $email): ?stdClass {
    return $this->firstByAttributes([
      'account_email' => $email,
    ]);
  }

}
