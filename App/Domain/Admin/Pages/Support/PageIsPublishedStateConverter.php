<?php
declare(strict_types=1);


namespace Domain\Admin\Pages\Support;

use Src\Converter\Converter;
use Src\Translation\Translation;

final class PageIsPublishedStateConverter extends Converter
{
    public function toReadable(): string
    {
        if ((bool) $this->var) {
            return Translation::get('admin_page_is_published');
        }

        return Translation::get('admin_page_is_not_published');
    }
}
