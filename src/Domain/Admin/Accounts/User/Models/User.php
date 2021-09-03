<?php
declare(strict_types=1);

namespace Domain\Admin\Accounts\User\Models;

use Components\ComponentsTrait;
use Components\Header\Redirect;
use Domain\Admin\Authentication\Actions\LogUserOutAction;
use Domain\Admin\Authentication\Support\IDEncryption;
use Src\Model\Model;
use Src\Model\Scopes\SoftDelete\SoftDelete;
use stdClass;

/**
 * Provides a model for the account table to interact with the database.
 *
 * @package Domain\Admin\Accounts\User\Models
 */
final class User extends Model {

  use ComponentsTrait;
  use SoftDelete;

  /**
   * {@inheritdoc}
   */
  protected string $table = 'account';

  /**
   * {@inheritdoc}
   */
  protected string $primaryKey = 'account_ID';

  /**
   * {@inheritdoc}
   */
  protected string $softDeletedKey = 'account_is_deleted';

  /**
   * The follow rights option are available.
   *
   * - Accessible for everyone
   * - Admin
   * - Super Admin
   * - Developer.
   *
   * @var int
   */
  public const GUEST = 0;
  public const ADMIN = 1;
  public const SUPER_ADMIN = 2;
  public const DEVELOPER = 3;

  private ?stdClass $account;

  /**
   * User constructor.
   */
  public function __construct() {
    $this->initializeSoftDelete();

    $this->account = $this->find($this->getId());

    $this->authorizeUser();
  }

  /**
   * Get the account of the user.
   *
   * If the user is logged in the account will be returned.
   * Otherwise an empty std class.
   *
   * @param string $email
   *
   * @return object|null
   */
  public function getByEmail(string $email): ?stdClass {
    return $this->firstByAttributes([
      'account_email' => $email,
    ]);
  }

  /**
   * Get the id of the user.
   *
   * It does not matter if the user is logged in.
   * If the user is logged in, the id of the user will be returned.
   * Otherwise the guest id is returned.
   *
   * @return int the id of the user
   */
  public function getId(): int {
    $idEncryption = new IDEncryption();

    return $idEncryption->decrypt($this->session()->get('userID'));
  }

  /**
   * Get the name of the user.
   *
   * @return string
   */
  public function getName(): string {
    return $this->account->account_name ?? '';
  }

  /**
   * Get the rights of the user.
   *
   * It does not matter if the user is logged in.
   * If the user is logged in, the rights of the user will be returned.
   * Otherwise the guest rights are returned.
   *
   * @return int the rights of the user, guest, admin or super admin
   */
  public function getRights(): int {
    return (int) ($this->account->account_rights ?? self::GUEST);
  }

  /**
   * Get the account of the user.
   *
   * @return object|null
   */
  public function getAccount(): ?stdClass {
    return $this->account;
  }

  /**
   * Determine if the user is logged in.
   *
   * @return bool
   */
  public function isLoggedIn(): bool {
    return $this->getRights() > self::GUEST;
  }

  /**
   * Authorize the user.
   *
   * - Check if the rights are valid and if not log the user out.
   * - Check if the user is really the user which he says that he is
   *   and if not log the user out.
   *
   * @return void|Redirect
   */
  private function authorizeUser() {
    $idEncryption = new IDEncryption();

    $rights = $this->getRights();
    if ($rights > self::GUEST && $rights < self::DEVELOPER) {
      return;
    }

    if (!(bool) ($this->account->account_is_blocked ?? TRUE)) {
      return;
    }

    if ($idEncryption->validateHash($this->account->account_login_token ?? '', $this->session()->get('userID'))) {
      return;
    }

    if (!$this->isLoggedIn()) {
      return;
    }

    return $this->logout();
  }

  /**
   * Log the current user out and redirect to the log in page.
   *
   * @return \Components\Header\Redirect
   */
  public function logout(): Redirect {
    $logout = new LogUserOutAction($this);
    $logout->execute();

    return new Redirect('/admin');
  }

}
