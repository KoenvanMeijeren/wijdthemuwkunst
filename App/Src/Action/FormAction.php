<?php
declare(strict_types=1);


namespace Src\Action;

use Src\Security\CSRF;

abstract class FormAction extends Action
{
    /**
     * @inheritDoc
     */
    protected function authorize(): bool
    {
        if (! CSRF::validate()) {
            return false;
        }

        return true;
    }
}
