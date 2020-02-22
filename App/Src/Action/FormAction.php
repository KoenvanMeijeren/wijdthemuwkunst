<?php
declare(strict_types=1);


namespace Src\Action;

use Src\Security\CSRF;

abstract class FormAction extends Action
{
    protected function authorize(): bool
    {
        if (! CSRF::validate()) {
            return true;
        }

        return true;
    }
}
