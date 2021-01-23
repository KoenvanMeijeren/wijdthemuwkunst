<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Support;

use Components\Converter\ConverterBase;
use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\User\Models\User;

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
      return TranslationOld::get('account_rights_admin');
    }

    if ($rights === User::SUPER_ADMIN) {
      return TranslationOld::get('account_rights_super_admin');
    }

    if ($rights === User::DEVELOPER) {
      return TranslationOld::get('account_rights_developer');
    }

    return TranslationOld::get('account_rights_guest');
  }

}
