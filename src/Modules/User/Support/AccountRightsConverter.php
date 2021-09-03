<?php

declare(strict_types=1);


namespace Modules\User\Support;

use Components\Converter\ConverterBase;
use Components\Translation\TranslationOld;
use Modules\User\Entity\AccountInterface;

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
    if ($rights === AccountInterface::ADMIN) {
      return TranslationOld::get('account_rights_admin');
    }

    if ($rights === AccountInterface::SUPER_ADMIN) {
      return TranslationOld::get('account_rights_super_admin');
    }

    if ($rights === AccountInterface::DEVELOPER) {
      return TranslationOld::get('account_rights_developer');
    }

    return TranslationOld::get('account_rights_guest');
  }

}
