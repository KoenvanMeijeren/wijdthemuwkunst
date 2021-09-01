<?php

declare(strict_types=1);


namespace Modules\User\Support;

use Components\Converter\ConverterBase;
use Components\Translation\TranslationOld;

/**
 * Provides a class for converting account is blocked states.
 *
 * @package Modules\User\Support
 */
final class AccountBlockStateConverter extends ConverterBase {

  /**
   * {@inheritDoc}
   */
  public function toReadable(): string {
    if (!(bool) $this->var) {
      return '';
    }

    return ' - ' . TranslationOld::get('account_is_blocked');
  }

}
