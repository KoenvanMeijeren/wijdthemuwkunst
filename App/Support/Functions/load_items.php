<?php

declare(strict_types=1);

use Src\Validate\Validate;

function includeFile(string $filename, $vars = null)
{
    if ($vars !== null) {
        extract($vars, EXTR_SKIP);
    }

    Validate::var($filename)->fileExists();

    return include $filename;
}

function getFileContents(string $filename)
{
    Validate::var($filename)->fileExists();

    return file_get_contents($filename);
}

/**
 * Load an image and return it.
 *
 * @param string $name     the filename
 * @param string $fallback the fallback for the filename
 *
 * @return string the image or a fallback otherwise nothing
 */
function includeImage(string $name, string $fallback)
{
    if (file_exists($_SERVER['DOCUMENT_ROOT'].$name)) {
        return $name;
    }

    if (file_exists($_SERVER['DOCUMENT_ROOT'].$fallback)) {
        return $fallback;
    }

    return '';
}
