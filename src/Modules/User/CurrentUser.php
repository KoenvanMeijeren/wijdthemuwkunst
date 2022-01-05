<?php
declare(strict_types=1);

namespace Modules\User;

use Components\ComponentsTrait;
use Components\Route\RouteRights;
use Modules\Authentication\Support\IDEncryption;
use Modules\User\Entity\Account;
use Modules\User\Entity\AccountInterface;
use System\Entity\EntityManagerInterface;

/**
 * Provides a class for getting the current user.
 *
 * @package Modules\User
 */
class CurrentUser implements CurrentUserInterface {

  use ComponentsTrait;

  /**
   * The storage.
   *
   * @var \System\Entity\EntityManagerInterface
   */
  protected EntityManagerInterface $storage;

  /**
   * Creates a new current user object.
   */
  public function __construct() {
    $this->storage = $this->getEntityManager()->getStorage(Account::class);
  }

  /**
   * {@inheritDoc}
   */
  public function get(): AccountInterface {
    $default_user = $this->storage->create([
      'rights' => RouteRights::GUEST->value,
    ]);

    $user_id = $this->getUserId();
    if (!$user_id) {
      return $default_user;
    }

    $user = $this->storage->load($user_id);
    if (!$user) {
      return $default_user;
    }

    return $user;
  }

  /**
   * {@inheritDoc}
   */
  public function isLoggedIn(): bool {
    return $this->get()->getRouteRights()->hasAccess(RouteRights::ADMIN);
  }

  /**
   * Get the id of the user.
   *
   * It does not matter if the user is logged in.
   * If the user is logged in, the id of the user will be returned.
   * Otherwise, the guest id is returned.
   *
   * @return int the id of the user
   */
  protected function getUserId(): int {
    $idEncryption = new IDEncryption();

    return $idEncryption->decrypt($this->session()->get('userID'));
  }

}
