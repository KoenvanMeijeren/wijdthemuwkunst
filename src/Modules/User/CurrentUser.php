<?php

namespace Modules\User;

use Components\ComponentsTrait;
use Domain\Admin\Authentication\Support\IDEncryption;
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
    if ($id = $this->getUserId()) {
      return $this->storage->load($id);
    }

    return $this->storage->create([
      'rights' => AccountInterface::GUEST,
    ]);
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
