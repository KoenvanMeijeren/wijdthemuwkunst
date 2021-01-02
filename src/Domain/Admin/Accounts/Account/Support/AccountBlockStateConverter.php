<?php

declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Support;

use Src\Converter\ConverterBase;
use Src\Translation\Translation;

/**
 * Provides a class for converting account is blocked states.
 *
 * @package Domain\Admin\Accounts\Account\Support
 */
final class AccountBlockStateConverter extends ConverterBase {

  /**
   * {@inheritDoc}
   */
  public function toReadable(): string {
    if (!(bool) $this->var) {
      return '';
    }

    return ' - ' . Translation::get('account_is_blocked');
  }

}
