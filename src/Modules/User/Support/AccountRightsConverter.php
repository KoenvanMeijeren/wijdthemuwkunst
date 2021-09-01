<?php

declare(strict_types=1);


namespace Modules\User\Support;

use Components\Converter\ConverterBase;
use Components\Translation\TranslationOld;
use Domain\Admin\Accounts\User\Models\User;

/**
 * Provides a class for converting account rights.
 *
 * @package Modules\User\Support
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
