<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Support;

use Domain\Admin\Accounts\User\Models\User;
use Src\Converter\ConverterBase;
use Src\Translation\Translation;

/**
 * Provides a class for converting account rights.
 *
 * @package Domain\Admin\Accounts\Account\Support
 */
final class AccountRightsConverter extends ConverterBase {

  /**
   * {@inheritDoc}
   */
  public function toReadable(): string {
    $rights = (int) $this->var;
    if ($rights === User::ADMIN) {
      return Translation::get('account_rights_admin');
    }

    if ($rights === User::SUPER_ADMIN) {
      return Translation::get('account_rights_super_admin');
    }

    if ($rights === User::DEVELOPER) {
      return Translation::get('account_rights_developer');
    }

    return Translation::get('account_rights_guest');
  }

}
