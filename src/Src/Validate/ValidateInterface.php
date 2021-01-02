<?php
declare(strict_types=1);

namespace Src\Validate;

/**
 * Provides an interface for validation classes.
 *
 * @package src\Validate
 */
interface ValidateInterface
{

    /**
     * Sets the variable for validation.
     *
     * @param mixed $var
     *   The var to be validated.
     *
     * @return Validate
     *   The validate object.
     */
    public static function var(mixed $var): Validate;

}
