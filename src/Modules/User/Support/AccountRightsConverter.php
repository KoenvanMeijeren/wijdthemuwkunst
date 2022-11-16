<?php

declare(strict_types=1);


namespace Modules\User\Support;

use Components\Converter\ConverterBase;
use Components\Route\RouteRights;
use Components\Translation\TranslationOld;

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
    if ($rights === RouteRights::ADMIN->value) {
      return TranslationOld::get('account_rights_admin');
    }

    if ($rights === RouteRights::SUPER_ADMIN->value) {
      return TranslationOld::get('account_rights_super_admin');
    }

    if ($rights === RouteRights::DEVELOPER->value) {
      return TranslationOld::get('account_rights_developer');
    }

    return TranslationOld::get('account_rights_guest');
  }

}
