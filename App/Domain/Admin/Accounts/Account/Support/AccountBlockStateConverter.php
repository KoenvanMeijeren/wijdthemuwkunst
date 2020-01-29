<?php
declare(strict_types=1);


namespace Domain\Admin\Accounts\Account\Support;

use Src\Converter\Converter;
use Src\Translation\Translation;

final class AccountBlockStateConverter extends Converter
{
    public function toReadable(): string
    {
        if (!(bool) $this->var) {
            return '';
        }

        return ' - ' . Translation::get('account_is_blocked');
    }
}
